<?php


namespace App\Strategies\CheckOut;


class FR1 extends CheckoutBase
{
    public function __construct($price, $purchases)
    {
        parent::__construct($price, $purchases);
    }

    public function calcBuyOneGetOneOffer($a)
    {
        $discount = 0;

        if($this->purchases >= 2) {
            $discount = -$this->price;
        }

        return $discount;
    }
}