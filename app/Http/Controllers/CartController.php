<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{

    public function index()
    {
        $userId = Auth::guard('public_user')->id();
        $sessionId = request()->cookie('cart_session_id');

        $cartItems = Cart::with(['product.hotDeal', 'variant'])
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('public_user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })->get();

        return view('phone_lab.pages.cart', compact('cartItems'));
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    public function remove($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($product->has_variants) {
            $request->validate([
                'variant_id' => 'required|exists:product_variants,id',
            ], [
                'variant_id.required' => 'Please select your preferred Memory and Color variant before adding to cart.'
            ]);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $userId = Auth::guard('public_user')->id();
        $sessionId = $request->cookie('cart_session_id');

        if (!$userId && !$sessionId) {
            $sessionId = Str::uuid()->toString();
            Cookie::queue('cart_session_id', $sessionId, 60 * 24 * 30);
        }

        $cartItem = Cart::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('public_user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
            ->where('product_id', $request->product_id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'public_user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Successfully added to cart!');
    }
}
