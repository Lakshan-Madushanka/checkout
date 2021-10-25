<?php


namespace App\Strategies\CheckOut;


class SR1 extends CheckoutBase
{
    public function __construct($price, $purchases)
    {
        parent::__construct($price, $purchases);
    }

    public function calcPriceDiscount($limit, $discountPrice)
    {
        $discount = 0;

        if($this->purchases >= 3) {
            $discount = -$this->purchases * ($this->price - $discountPrice);
        }

        return $discount;
    }
}