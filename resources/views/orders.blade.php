@extends('layouts.app')

@section('title','Order Saya - Templatenesia')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h2 class="text-2xl font-bold mb-6">Tracking Order</h2>

    @if(count($orders) === 0)
        <div class="bg-white p-6 rounded shadow">Tidak ada order yang terkait dengan session ini.</div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white p-4 rounded shadow flex items-center justify-between">
                    <div>
                        <div class="font-bold">Invoice: {{ $order->invoice_id }}</div>
                        <div class="text-sm text-gray-600">Status: {{ $order->status }}</div>
                        <div class="text-sm text-gray-600">Total: Rp {{ number_format($order->total,0,',','.') }}</div>
                    </div>
                    <div>
                        <a href="/" class="text-iosBlue font-semibold">Lihat Produk</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
