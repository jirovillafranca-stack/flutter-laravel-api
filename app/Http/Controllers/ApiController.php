<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact' => $request->contact,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'Registered successfully' . $user
        ]);
    }
    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }
    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }
    public function addFood(Request $request)
    {
        $food = Food::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return response()->json($food);
    }
    public function getFoods()
    {
        return response()->json(Food::all());
    }
    public function order(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user()->id,
            'items' => json_encode($request->items),
        ]);

        return response()->json([
            'message' => 'Order saved'
        ]);
    }
}
