<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\FAQ;
use App\Models\PaymentMethod;

class PageController extends Controller
{
    public function home()
    {
        $settings = Setting::all()->pluck('value','key')->toArray();
        $products = Product::where('is_active', 1)->with('category')->latest()->take(12)->get();
        $testimonials = Testimonial::where('is_active', 1)->latest()->take(6)->get();
        $faqs = FAQ::where('is_active', 1)->latest()->take(6)->get();

        $products_js = $products->map(function ($p) {
            return [
                'name' => $p->title,
                'description' => $p->description ?? '',
                'category' => $p->category?->name ?? 'Produk',
                'price' => $p->price,
                'oldPrice' => $p->discount_price ?? null,
                'rating' => 4.9,
                'sold' => '0',
                'image' => $p->image ?? 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 300%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22400%22 height=%22300%22/%3E%3C/svg%3E',
                'id' => $p->id,
                'slug' => $p->slug ?? null,
            ];
        })->toArray();

        $testimonials_js = $testimonials->map(function ($t) {
            return [
                'name' => $t->name,
                'text' => $t->testimonial,
                'image' => $t->image ?? 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Crect fill=%22%23e0e0e0%22 width=%22100%22 height=%22100%22/%3E%3C/svg%3E',
            ];
        })->toArray();

        $faqs_js = $faqs->map(function ($f) {
            return [
                'q' => $f->question,
                'a' => $f->answer,
            ];
        })->toArray();

        $whatsapp_number = $settings['whatsapp_number'] ?? '628123456789';

        return view('homepage', compact('settings','products','products_js','testimonials_js','faqs_js','whatsapp_number'));
    }

    public function products()
    {
        $products = Product::where('is_active', 1)->with('category')->latest()->get();
        
        $products_array = $products->map(function ($p) {
            return [
                'id' => $p->id,
                'title' => $p->title,
                'description' => $p->description ?? '',
                'category' => $p->category?->name ?? 'Produk',
                'price' => $p->price,
                'old_price' => $p->discount_price,
                'image' => $p->image ?? 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 300%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22400%22 height=%22300%22/%3E%3C/svg%3E',
                'is_popular' => $p->is_popular ?? false,
                'rating' => 4.9,
            ];
        })->toArray();

        return view('products', ['products' => $products_array]);
    }

    public function guide()
    {
        return view('guide');
    }

    public function product()
    {
        $id = request()->query('id');
        $slug = request()->query('slug');
        $product = null;
        if ($id) {
            $product = Product::with('category')->find($id);
        } elseif ($slug) {
            $product = Product::with('category')->where('slug', $slug)->first();
        }
        if (! $product) {
            $product = Product::with('category')->where('is_active',1)->first();
        }

        $relatedProducts = Product::where('is_active', 1)
            ->where('id', '!=', $product?->id)
            ->latest()
            ->take(4)
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->title,
                    'price' => $p->price,
                    'oldPrice' => $p->discount_price,
                    'image' => $p->image ?? 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 300 300%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22300%22 height=%22300%22/%3E%3C/svg%3E',
                ];
            })
            ->toArray();

        $productData = $product ? [
            'id' => $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'oldPrice' => $product->discount_price,
            'description' => $product->description,
            'image' => $product->image,
            'rating' => 4.9,
            'sold' => 1200,
        ] : null;

        return view('product-detail', compact('product', 'relatedProducts', 'productData'));
    }

    public function checkout()
    {
        $product = Product::find(request()->query('id', request()->query('product_id', 1)));
        if (!$product) $product = Product::first();

        $product->old_price = $product->discount_price;

        $manualPaymentMethods = PaymentMethod::where('type', 'manual')->where('is_active', 1)->orderBy('sort_order')->get();
        
        return view('checkout', compact('product', 'manualPaymentMethods'));
    }

    public function payment()
    {
        $invoiceId = session('invoice_id') ?? rand(100000, 999999);
        $product = null;
        if ($pid = request()->query('product_id')) {
            $product = Product::find($pid);
        }
        $midtrans = session('midtrans') ?? null;
        return view('pembayaran', compact('invoiceId','product','midtrans'));
    }
}
