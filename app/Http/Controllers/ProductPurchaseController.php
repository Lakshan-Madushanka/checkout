<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ProductPurchaseController extends Controller
{
    public function store(Product $product)
    {
        $product->purchases()->save(new Purchase());
    }

    public function checkOut()
    {

    }
}
