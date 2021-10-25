<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\ProductRepositoryInterface;
use App\Services\CheckoutService;
use App\Strategies\CheckOut\Checkout;

class ProductController extends Controller
{
    private $productRepository;
    private $checkoutService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CheckoutService $checkoutService

    ) {
        $this->productRepository = $productRepository;
        $this->checkoutService = $checkoutService;
    }

    public function checkOut()
    {
        $pricing_rules
                  = [
            'FR1' => [
                'rules' => [
                    'calcBuyOneGetOneOffer' => ['limit' => 3, 'discount' => 4.5], // method name
                ],
            ],
            'SR1' => [
                'rules' => [
                    'calcPriceDiscount' => ['limit' => 3, 'discount' => 4.5], //rule and related args
                ],
            ],
        ];

        $products = $this->productRepository->getProductsPurchases();

        $co = new Checkout($pricing_rules);

        $total = $this->checkoutService->calcTotal($products, $co);

        return '&euro;'.round($total, 2);

    }


}
