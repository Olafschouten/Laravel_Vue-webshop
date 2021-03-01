<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * @param $id
     * @return AnonymousResourceCollection
     */
    public function getOrdersFromUser($id): AnonymousResourceCollection
    {

        $orders = Order::where('user_id', $id)->orderBy('created_at')->paginate(1);
        //        if ($orders['data'] !== null) {
        $orders->transform(function ($order, $key) {
            $order->cart = json_decode($order->cart);

            return $order;
        });

        return ProductResource::collection($orders);

        //        return response()->json($orders, 200);
        //        }
        //        return response()->json("No Order found", 200);
    }
}
