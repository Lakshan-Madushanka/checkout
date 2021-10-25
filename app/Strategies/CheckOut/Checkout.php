<?php


namespace App\Strategies\CheckOut;


use ReflectionClass;

class Checkout
{
    public $total = 0;
    private $pricingRules;

    public function __construct(array $pricingRules)
    {
        $this->pricingRules = $pricingRules;
    }

    public function scan($item)
    {
        $pricingRules = $this->pricingRules;

        if (class_exists("App\Strategies\CheckOut\\".$item->product_code)) {
            $strategy = new ReflectionClass("App\Strategies\CheckOut\\"
                .$item->product_code);
            $strategy = $strategy->newInstanceArgs([
                $item->price, $item->purchases_count,
            ]);
            $this->executeCalc($item->product_code, $pricingRules, $strategy);
        }
    }

    public function executeCalc($productCode, $pricingRules, $strategy)
    {
        $productTotal = $strategy->calcMainTotal();

        if (key_exists($productCode, $pricingRules)) {
            $rules = $pricingRules[$productCode]['rules'];

            foreach ($rules as $rule => $args) {
                if (method_exists($strategy, $rule)) {
                    $args = array_values($args);

                    $discountOrTax = $strategy->{$rule}(...$args);

                    $productTotal = $productTotal + $discountOrTax;
                }
            }
        }

        $this->total += $productTotal;
    }

}