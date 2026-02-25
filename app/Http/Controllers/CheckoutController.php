<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Services\WhatsAppService;
use App\Services\MidtransService;
use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderPaidNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseReceipt;
use App\Models\PaymentMethod;

class CheckoutController extends Controller
{
    public function checkout(Request $request, MidtransService $midtrans, WhatsAppService $wa)
    {
        $validBankCodes = PaymentMethod::where('type', 'manual')->where('is_active', 1)->pluck('bank_code')->toArray();
        
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'paymentMethod' => 'required|in:manual,midtrans',
            'bankCode' => 'required_if:paymentMethod,manual|nullable|in:' . implode(',', $validBankCodes),
        ]);

        $productId = $validated['product_id'];
        $qty = (int) $validated['quantity'];
        $phone = $validated['phone'];
        $email = $validated['email'];
        $name = $validated['name'];
        $paymentMethod = $validated['paymentMethod']; 
        $bankCode = $validated['bankCode'] ?? null;

        $product = Product::find($productId);
        if (! $product) {
            return response()->json(['ok' => false, 'message' => 'Product not found'], 404);
        }

        $discountPrice = (int) $product->discount_price;
        $normalPrice = (int) $product->price;
        
        $sellingPrice = ($discountPrice > 0 && $discountPrice < $normalPrice) 
            ? $discountPrice 
            : $normalPrice;
        
        $total = $sellingPrice * $qty;

        $voucherCode = $request->input('voucherCode');
        $appliedVoucher = null;
        if (!empty($voucherCode)) {
            $voucher = \App\Models\Voucher::where('code', $voucherCode)->where('is_active', true)->first();
            if ($voucher && (!$voucher->start_date || $voucher->start_date <= now()) && (!$voucher->end_date || $voucher->end_date >= now()) && (!$voucher->usage_limit || $voucher->usage_count < $voucher->usage_limit)) {
                $appliedVoucher = $voucher;
                if ($voucher->type === 'nominal') {
                    $total -= $voucher->value;
                } else if ($voucher->type === 'percentage') {
                    $total -= $total * ($voucher->value / 100);
                }
                if ($total < 0) $total = 0;
            }
        }
        
        \Log::info('Checkout Calc', ['product' => $productId, 'qty' => $qty, 'discount' => $discountPrice, 'normal' => $normalPrice, 'selling' => $sellingPrice, 'total' => $total, 'request_body' => $request->all()]);
        $invoice = 'INV-' . strtoupper(Str::random(8));

        $metaData = [
            'method' => $paymentMethod,
        ];

        if ($paymentMethod === 'manual' && $bankCode) {
            $bank = PaymentMethod::where('bank_code', $bankCode)
                ->where('type', 'manual')
                ->where('is_active', true)
                ->first();

            if (! $bank) {
                return response()->json(['ok' => false, 'message' => 'Bank not found (Invalid Code)'], 404);
            }

            $metaData['bank_name'] = $bank->name;
            $metaData['account_number'] = $bank->account_number;
            $metaData['account_name'] = $bank->account_name;
        }

        $order = Order::create([
            'invoice_id' => $invoice,
            'product_id' => $product->id,
            'quantity' => $qty,
            'total' => $total,
            'status' => 'pending',
            'customer_name' => $name,
            'customer_phone' => $phone,
            'customer_email' => $email,
            'meta' => $metaData,
        ]);

        if ($appliedVoucher) {
            $appliedVoucher->increment('usage_count');
        }

        if ($phone) {
            try {
                $notification = new OrderCreatedNotification($order, $phone);
                $waMessage = $notification->toWhatsApp();
                $wa->send($waMessage['to'], $waMessage['message']);
            } catch (\Throwable $e) {
                \Log::error('Failed to send order created notification', ['invoice' => $invoice]);
            }
        }

        session(['invoice_id' => $invoice]);

        if ($paymentMethod === 'manual' && $bankCode) {
            // Evaluasi bank sudah dilakukan di awal pembuatan meta order
            $bank = PaymentMethod::where('bank_code', $bankCode)->first();

            return response()->json([
                'ok' => true,
                'invoice' => $invoice,
                'bankAccount' => $bank->account_number,
                'bankName' => $bank->name,
                'accountName' => $bank->account_name,
                'total' => $total,
                'message' => 'Silakan transfer ke rekening di atas',
            ]);

        } else if ($paymentMethod === 'midtrans') {
            try {
                $tx = $midtrans->createTransaction($order);
                if (is_array($tx) && isset($tx['redirect_url'])) {
                    $metaData['snap_url'] = $tx['redirect_url'];
                    $order->update(['meta' => $metaData]);
                }
            } catch (\Throwable $e) {
                \Log::error('MIDTRANS FAIL', ['msg' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
                $tx = null;
            }
            session(['midtrans' => $tx]);

            return response()->json([
                'ok' => true,
                'invoice' => $invoice,
                'total' => $total,
                'paymentUrl' => is_array($tx) ? ($tx['redirect_url'] ?? null) : null,
                'message' => 'Redirecting to payment gateway...',
            ]);
        } else {
            return response()->json(['ok' => false, 'message' => 'Invalid payment method'], 422);
        }
    }

    public function applyVoucher(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        
        $voucher = \App\Models\Voucher::where('code', $request->code)->where('is_active', true)->first();
        if (!$voucher) {
            return response()->json(['ok' => false, 'message' => 'Voucher tidak valid atau sudah ditarik.']);
        }
        
        $now = now();
        if ($voucher->start_date && $voucher->start_date > $now) {
            return response()->json(['ok' => false, 'message' => 'Voucher belum masuk masa aktif.']);
        }
        if ($voucher->end_date && $voucher->end_date < $now) {
            return response()->json(['ok' => false, 'message' => 'Voucher sudah kedaluwarsa.']);
        }
        if ($voucher->usage_limit && $voucher->usage_count >= $voucher->usage_limit) {
            return response()->json(['ok' => false, 'message' => 'Batas kuota penggunaan voucher telah habis.']);
        }
        
        return response()->json([
            'ok' => true,
            'voucher' => [
                'id' => $voucher->id,
                'code' => $voucher->code,
                'type' => $voucher->type,
                'value' => $voucher->value,
                'description' => $voucher->description
            ],
            'message' => 'Kupon berhasil diterapkan!'
        ]);
    }

    public function webhook(Request $request, WhatsAppService $wa)
    {
        $invoice = $request->input('invoice_id');
        $status = $request->input('status');

        $order = Order::where('invoice_id', $invoice)->first();
        if (! $order) {
            return response()->json(['ok' => false, 'message' => 'order not found'], 404);
        }

        $order->status = $status;
        $order->save();

        $phone = $order->customer_phone;
        if ($status === 'paid' && $phone) {
            try {
                $notification = new OrderPaidNotification($order, $phone);
                $waMessage = $notification->toWhatsApp();
                $wa->send($waMessage['to'], $waMessage['message']);
            } catch (\Throwable $e) {
                \Log::error('Failed to send payment notification', ['invoice' => $invoice, 'error' => $e->getMessage()]);
            }
        }

        if ($order->customer_email) {
            try {
                Mail::to($order->customer_email)->send(new PurchaseReceipt($order));
            } catch (\Throwable $e) {
                \Log::error('Failed to send email receipt', ['invoice' => $invoice]);
            }
        }

        if ($request->wantsJson() || $request->header('x-livewire')) {
            return response()->json(['ok' => true]);
        }

        session()->flash('status', 'Pembayaran telah diterima. Terima kasih.');
        return redirect()->route('home');
    }
}

