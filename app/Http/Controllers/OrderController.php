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
       $data = $this->orderService->getCheckoutForm();

        return view('orderForm', [
            'userProductsForOrder' => $data['userProductsForOrder'],
            'totalSum' => $data['totalSum'],
        ]);
    }

    public function getOrderForm(CreateOrderRequest $request)
    {
        $this->orderService->createOrder($request);
        return response()->redirectTo('/catalog');
    }

    public function getUserOrders(){

        $userOrders = $this->orderService->getAll();

        return view('userOrdersForm', [
            'userOrders' => $userOrders,
        ]);
    }
}
