<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
//        return response()->json($request->input()[0]['fullName'], 200);
//        try {
//            $this->validate($request, [
//                'cart' => 'required|string',
//                'fullName' => 'required|string',
//                'streetHouseNumber' => 'required|string',
//                'zip' => 'required|string',
//                'email' => 'required|email',
//            ]);
//        } catch (ValidationException $e) {
//            return response()->json($e, 500);
//        }

        return Order::create([
            "cart" => serialize($request->input()[0]['cart']),
            "user_id" => $request->input()[0]['user_id'],
            "fullName" => $request->input()[0]['fullName'],
            "streetHouseNumber" => $request->input()[0]['streetHouseNumber'],
            "zip" => $request->input()[0]['zip'],
            "email" => $request->input()[0]['email']
        ]);
    }
}
