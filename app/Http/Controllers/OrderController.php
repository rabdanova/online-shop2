<?php

namespace App\Http\Controllers;

use App\Http\DTO\OrderCreateDTO;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Services\OrderService;
use App\Models\Order;
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
        $dto = new OrderCreateDTO(
            $request->input('name'),
            $request->input('phone_number'),
            $request->input('comment', ''),
            $request->input('address'),
        );

        $this->orderService->createOrder($dto);
        return response()->redirectTo('/catalog');
    }

    public function getUserOrders(){

        $user = Auth::id();
        $userOrders = Order::with('orderProducts.product')->where('user_id', $user)->get();

        return view('userOrders', [
            'userOrders' => $userOrders,
        ]);
    }
}
