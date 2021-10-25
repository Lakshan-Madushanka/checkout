<?php


namespace App\Repositories\Eloquent;



use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProductsPurchases()
    {
       return Product::select('product_code', 'price')->withCount('purchases')->get();
    }
}