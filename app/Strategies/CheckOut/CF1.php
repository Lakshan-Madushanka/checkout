<?php


namespace App\Strategies\CheckOut;


class CF1 extends CheckoutBase
{
    public function __construct($price, $purchases)
    {
        parent::__construct($price, $purchases);
    }

    // implements  the rules below
}