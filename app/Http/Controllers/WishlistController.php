<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Memproses aksi Toggle (Tambah/Hapus) Wishlist
     */
    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['ok' => false, 'message' => 'Unauthorized'], 401);
        }

        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $action = 'removed';
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $validated['product_id']
            ]);
            $action = 'added';
        }

        $userWishlists = Wishlist::where('user_id', $user->id)->with('product')->get()->map(function($w) {
            $p = $w->product;
            $hasDiscount = $p->discount_price && $p->discount_price > 0 && $p->discount_price < $p->price;
            $currentPrice = $hasDiscount ? $p->discount_price : $p->price;
            $oldPrice = $hasDiscount ? $p->price : null;
            $imageUrl = 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 300%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22400%22 height=%22300%22/%3E%3C/svg%3E';
            if ($p->image) {
                $imageUrl = \Illuminate\Support\Str::startsWith($p->image, ['http://', 'https://']) ? $p->image : \Illuminate\Support\Facades\Storage::url($p->image);
            }
            return [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $currentPrice,
                'oldPrice' => $oldPrice,
                'image' => $imageUrl
            ];
        });

        return response()->json([
            'ok' => true,
            'action' => $action,
            'items' => $userWishlists
        ]);
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['ok' => false, 'message' => 'Unauthorized'], 401);
        }

        $userWishlists = Wishlist::where('user_id', $user->id)->with('product')->get()->map(function($w) {
            $p = $w->product;
            if (!$p) return null;
            
            $hasDiscount = $p->discount_price && $p->discount_price > 0 && $p->discount_price < $p->price;
            $currentPrice = $hasDiscount ? $p->discount_price : $p->price;
            $oldPrice = $hasDiscount ? $p->price : null;
            $imageUrl = 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 300%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22400%22 height=%22300%22/%3E%3C/svg%3E';
            if ($p->image) {
                $imageUrl = \Illuminate\Support\Str::startsWith($p->image, ['http://', 'https://']) ? $p->image : \Illuminate\Support\Facades\Storage::url($p->image);
            }
            return [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $currentPrice,
                'oldPrice' => $oldPrice,
                'image' => $imageUrl
            ];
        })->filter()->values();

        return response()->json([
            'ok' => true,
            'items' => $userWishlists
        ]);
    }
}
