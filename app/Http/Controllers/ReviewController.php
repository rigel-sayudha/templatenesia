<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string|min:10|max:1000',
            'customer_name' => 'nullable|string|max:100',
        ], [
            'product_id.required' => 'Produk tidak valid.',
            'rating.required'     => 'Silakan pilih rating.',
            'comment.required'    => 'Komentar tidak boleh kosong.',
            'comment.min'         => 'Komentar minimal 10 karakter.',
        ]);

        $name = null;
        $userId = null;

        if (auth()->check()) {
            $userId = auth()->id();
            $name = auth()->user()->name;
        } else {
            $name = $request->customer_name ?: 'Anonim';
        }

        // Cegah review ganda: satu user/guest per produk (optional, skip bila tidak perlu)
        Review::create([
            'product_id'    => $request->product_id,
            'user_id'       => $userId,
            'customer_name' => $name,
            'rating'        => $request->rating,
            'comment'       => $request->comment,
            'is_visible'    => true, // auto visible; admin bisa nonaktifkan
        ]);

        return back()
            ->with('review_success', 'Terima kasih! Ulasan Anda berhasil dikirim.')
            ->withFragment('ulasan'); // Buka tab ulasan setelah submit
    }
}
