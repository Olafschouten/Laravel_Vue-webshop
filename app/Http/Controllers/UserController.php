<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getOrders()
    {
        $user = Auth::user();
        dd($user);
        // $orders = Order::where('user_id', 1);

        // $orders = Auth::user()->orders;
        // $orders->transform(function ($order, $key) {
        //     $order->cart = unserialize($order->cart);
        //     return $order;
        // });

//        return ["user" => $user->id];
    }
}
