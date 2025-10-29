<?php

namespace App\Http\Services;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function createOrder(CreateOrderRequest $request)
    {
        $user = Auth::id();

        $order = Order::query()->create([
            'user_id' => $user,
            'name' => $request['name'],
            'phone_number' => $request['phone_number'],
            'address' => $request['address'],
            'comment' => $request['comment'],
        ]);

        $userProducts = UserProduct::with('product')->where('user_id', $user)->get();


        foreach ($userProducts as $userProduct) {
//            print_r($userProduct->product->id);exit;
            if ($userProduct->product) { // проверка нужна
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $userProduct->product->id,
                    'amount' => $userProduct->amount,
                ]);
            }

            UserProduct::query()->where('user_id', $user)->delete();
        }
    }
}
