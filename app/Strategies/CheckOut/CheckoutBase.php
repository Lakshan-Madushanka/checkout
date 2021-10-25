<?php


namespace App\Strategies\CheckOut;


abstract class CheckoutBase
{
    protected $price;
    protected $purchases;

    public function __construct($price, $purchases)
    {
        $this->price = $price;
        $this->purchases = $purchases;
    }

    public function calcMainTotal(): float
    {
        return $this->price * $this->purchases;
    }
}