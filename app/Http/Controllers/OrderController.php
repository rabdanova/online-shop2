<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Services\OrderService;
use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class OrderController
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
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

        return view('orderForm', [
            'userProductsForOrder' => $userProductsForOrder,
            'totalSum' => $totalSum,
        ]);
    }

    public function getOrderForm(CreateOrderRequest $request)
    {
        $this->orderService->createOrder($request);
        return response()->redirectTo('/catalog');
    }
}
