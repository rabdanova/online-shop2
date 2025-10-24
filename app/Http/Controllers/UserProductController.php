<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class UserProductController
{
    public function cart()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userId = Auth::id();
        $userProducts = UserProduct::query()->where('user_id', $userId)->get();
        $cart = [];

        foreach ($userProducts as $userProduct) {

            $productId = $userProduct->product_id;
            $product = Product::find($productId);

            if ($product) {
                $product->amount = $userProduct->amount;
                $cart[] = $product;
            }
        }
        return view('userProduct', compact('cart'));
    }

    public function addUserProduct()
    {
        $userId = Auth::id();
        $productId = request('product_id');
        $result = UserProduct::query()->where('user_id', $userId)->where('product_id', $productId)->first();

        if (empty($result)) {
            UserProduct::query()->create([
                'user_id' => $userId,
                'product_id' => $productId,
                'amount' => 1
            ]);
        } else {
            UserProduct::query()->increment('amount');
        }

    }

    public function removeUserProduct()
    {
        $userId = Auth::id();
        $productId = request('product_id');
        $result = UserProduct::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($result) {
            $result->decrement('amount');

            if ($result->amount <= 0) {
                $result->delete();
            }
        }
    }
}
