<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Cart is empty'
            ]);
        }

        $total = 0;

        foreach ($cartItems as $item) {
            $food = Food::find($item->food_id);
            $total += $food->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
        ]);

        foreach ($cartItems as $item) {
            $food = Food::find($item->food_id);

            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $food->id,
                'quantity' => $item->quantity,
                'price' => $food->price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'status' => true,
            'message' => 'Order placed successfully',
            'order_id' => $order->id
        ]);
    }
    public function myOrders()
    {
        $orders = Order::with('items.food')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($orders);
    }
}
