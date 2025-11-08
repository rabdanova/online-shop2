<?php

namespace App\Http\Services;

use App\Http\DTO\OrderCreateDTO;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function createOrder(OrderCreateDTO $orderCreateDTO)
    {
        $user = Auth::id();

        $userProducts = UserProduct::with('product')->where('user_id', $user)->get();

        DB::beginTransaction();

        try {

            $order = Order::query()->create([
                'user_id' => $user,
                'name' => $orderCreateDTO->getName(),
                'phone_number' => $orderCreateDTO->getPhoneNumber(),
                'address' => $orderCreateDTO->getAddress(),
                'comment' => $orderCreateDTO->getComment(),
            ]);

            foreach ($userProducts as $userProduct) {
                if ($userProduct->product) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $userProduct->product->id,
                        'amount' => $userProduct->amount,
                    ]);
                }

                UserProduct::query()->where('user_id', $user)->delete();
            }
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

    }

}
