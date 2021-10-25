<?php

namespace App\Providers;

use App\Models\Product;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ProductRepositoryInterface::class, function($app) {
            return new ProductRepository($app->make(Product::class));
        });
    }
}
