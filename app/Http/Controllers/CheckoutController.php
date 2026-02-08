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

        $sellingPrice = ($product->discount_price && $product->discount_price < $product->price) 
            ? $product->discount_price 
            : $product->price;
        
        $total = ($sellingPrice ?? 0) * $qty;
        $invoice = 'INV-' . strtoupper(Str::random(8));

        $order = Order::create([
            'invoice_id' => $invoice,
            'product_id' => $product->id,
            'quantity' => $qty,
            'total' => $total,
            'status' => 'pending',
            'customer_name' => $name,
            'customer_phone' => $phone,
            'customer_email' => $email,
        ]);

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
            $bank = PaymentMethod::where('bank_code', $bankCode)
                ->where('type', 'manual')
                ->where('is_active', true)
                ->first();

            if (! $bank) {
                return response()->json(['ok' => false, 'message' => 'Bank not found'], 404);
            }

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
            } catch (\Throwable $e) {
                $tx = null;
            }
            session(['midtrans' => $tx]);

            return response()->json([
                'ok' => true,
                'invoice' => $invoice,
                'paymentUrl' => $tx?->redirect_url ?? null,
                'message' => 'Redirecting to payment gateway...',
            ]);
        } else {
            return response()->json(['ok' => false, 'message' => 'Invalid payment method'], 422);
        }
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

