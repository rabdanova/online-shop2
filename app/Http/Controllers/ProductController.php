<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController
{
    public function getCatalog()
    {
        $products = Product::all();

        return view('catalog', compact('products'));
    }
}
