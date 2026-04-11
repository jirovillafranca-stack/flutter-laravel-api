<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // ADD TO CART
    public function addToCart(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::create([
            'user_id' => Auth::id(),
            'food_id' => $request->food_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Added to cart',
            'cart' => $cart
        ]);
    }

    // GET CART
    public function getCart()
    {
        $cart = Cart::with('food')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($cart);
    }

    // CLEAR CART
    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'status' => true,
            'message' => 'Cart cleared'
        ]);
    }
    public function myCart()
    {
        return Cart::where('user_id', Auth::id())->with('food')->get();
    }
}
