<?php


namespace App\Services;


class CheckOutService
{
    public function calcTotal($products, $co)
    {
        $products->each(function ($product) use ($co) {
            $co->scan($product);
        });

        return $co->total;
    }
}