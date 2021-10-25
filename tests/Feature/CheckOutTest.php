<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\ProductRepositoryInterface;
use App\Services\CheckOutService;
use App\Strategies\CheckOut\Checkout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckOutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    private $pricing_rules = [
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


    public function test_data_set_1_fr1_fr1_fr1_sr1_cf1()
    {
        $productRepository = new ProductRepository(new Product());
        $checkOutService   = new CheckOutService();

        $this->get(route('productPurchase', 1)); //FR1
        $this->get(route('productPurchase', 1)); //FR1
        $this->get(route('productPurchase', 1));
        $this->get(route('productPurchase', 2)); //SR1
        $this->get(route('productPurchase', 3)); //CF1


        $products = $productRepository->getProductsPurchases();

        $co = new Checkout($this->pricing_rules);

        $total = $checkOutService->calcTotal($products, $co);

        $this->assertEquals('&euro;'. '22.45', '&euro;'.round($total, 2));
    }

    public function test_data_set_2_fr1_fr1()
    {
        $productRepository = new ProductRepository(new Product());
        $checkOutService   = new CheckOutService();

        $this->get(route('productPurchase', 1)); //FR1
        $this->get(route('productPurchase', 1));

        $products = $productRepository->getProductsPurchases();

        $co = new Checkout($this->pricing_rules);

        $total = $checkOutService->calcTotal($products, $co);

        $this->assertEquals('&euro;'. '3.11', '&euro;'.round($total, 2));
    }

    public function test_data_set_3_sr1_sr1_fr1_sr1()
    {
        $productRepository = new ProductRepository(new Product());
        $checkOutService   = new CheckOutService();

        $this->get(route('productPurchase', 2)); //SR1
        $this->get(route('productPurchase', 2)); //SR1
        $this->get(route('productPurchase', 1)); //FR1
        $this->get(route('productPurchase', 2)); //SR1

        $products = $productRepository->getProductsPurchases();

        $co = new Checkout($this->pricing_rules);

        $total = $checkOutService->calcTotal($products, $co);

        $this->assertEquals('&euro;'. '16.61', '&euro;'.round($total, 2));
    }
}
