<?php

namespace App\Http\Services;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function getCheckoutForm()
    {
        $user = Auth::id();

        $userProducts = UserProduct::query()->where('user_id', $user)->get();

        $userProductsForOrder = [];
        $totalSum = 0;

        foreach ($userProducts as $userProduct) {
            $product = $userProduct->product;

            if ($product) {
                $price = $product->price;
                $name = $product->name;
                $amount = $userProduct->amount;
                $sum = $price * $amount;
                $totalSum += $sum;

                $userProductsForOrder[] = [
                    'product_id' => $product->id,
                    'name' => $name,
                    'price' => $price,
                    'amount' => $amount,
                    'sum' => $sum
                ];
            }
        }

        return [
            'userProductsForOrder' => $userProductsForOrder,
            'totalSum' => $totalSum,
        ];
    }

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
            if ($userProduct->product) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $userProduct->product->id,
                    'amount' => $userProduct->amount,
                ]);
            }

            UserProduct::query()->where('user_id', $user)->delete();
        }
    }

    public function getAll()
    {
        $user = Auth::id();
        $userOrders = Order::with('orderProducts.product')->where('user_id', $user)->get();

        foreach ($userOrders as $userOrder) {
            $sum = 0;
            foreach ($userOrder->orderProducts as $orderProduct) {

                $product = $orderProduct->product;

                $orderProduct->name = $product->name;
                $orderProduct->price = $product->price;
                $orderProduct->image_url = $product->image_url;
                $orderProduct->totalSum = $orderProduct->amount * $product->price;

                $sum += $orderProduct->totalSum;
            }

            $userOrder->total = $sum;
        }

        return $userOrders;
    }
}
