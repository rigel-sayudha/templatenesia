<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
*/

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/guide', [PageController::class, 'guide'])->name('guide');
Route::get('/test-csrf', [\App\Http\Controllers\TestCsrfController::class, 'testCsrf']);
Route::get('/test-livewire-modal', [\App\Http\Controllers\TestCsrfController::class, 'testLivewireModal']);
Route::get('/product', [PageController::class, 'product'])->name('product');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');


Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout/apply-voucher', [\App\Http\Controllers\CheckoutController::class, 'applyVoucher'])->name('checkout.applyVoucher');
Route::post('/checkout/process', [\App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout.process');
Route::post('/webhook/payment', [\App\Http\Controllers\CheckoutController::class, 'webhook'])->name('webhook.payment');

Route::get('/wishlist', function () {
    return view('wishlist');
})->name('wishlist');

Route::get('/orders', function () {
	$invoice = session('invoice_id');
	$orders = [];
	if ($invoice) {
		$orders = \App\Models\Order::where('invoice_id', $invoice)->get();
	}
	return view('orders', ['orders' => $orders]);
})->name('orders');

Route::get('/dev/webhook/payment', function () {
	$invoice = request('invoice_id');
	$status = request('status', 'paid');
	$order = \App\Models\Order::where('invoice_id', $invoice)->first();
	if (! $order) return response()->json(['ok' => false, 'message' => 'order not found'], 404);
	$order->status = $status;
	$order->save();
	return response()->json(['ok' => true, 'invoice' => $invoice, 'status' => $status]);
});

Route::get('/dev/create-order/{id}', function ($id) {
	$p = \App\Models\Product::find($id);
	if (! $p) return response('product not found', 404);
	$invoice = 'INV' . time();
	$order = \App\Models\Order::create([ 'invoice_id' => $invoice, 'product_id' => $p->id, 'quantity' => 1, 'total' => $p->price, 'status' => 'pending' ]);
	session(['invoice_id' => $invoice]);
	return response()->json(['ok' => true, 'invoice' => $invoice]);
});

Route::get('/debug-checkout', function() {
    $request = \Illuminate\Http\Request::create('/checkout', 'POST', [
        'product_id' => 7,
        'quantity' => 1,
        'name' => 'Rigel Sayudha',
        'email' => 'rigeldonovan@gmail.com',
        'phone' => '08122334455',
        'paymentMethod' => 'midtrans',
    ]);
    
    $controller = app(\App\Http\Controllers\CheckoutController::class);
    $wa = app(\App\Services\WhatsAppService::class);
    $midtrans = app(\App\Services\MidtransService::class);
    return $controller->checkout($request, $midtrans, $wa);
});

Route::post('/dev/send-wa/{phone}', [NotificationController::class, 'sendTestWhatsApp'])->name('dev.send-wa');

Route::post('/admin/toggle-theme', [\App\Http\Controllers\AdminThemeController::class, 'toggle'])->name('admin.toggle-theme');

Route::get('/_debug_session_driver', function () {
	return response()->json([
		'driver' => config('session.driver'),
		'cookie' => config('session.cookie'),
		'csrf' => csrf_token(),
		'session_id' => session()->getId(),
	]);
});
