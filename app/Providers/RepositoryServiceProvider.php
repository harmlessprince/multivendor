<?php

namespace App\Providers;

use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RepositoryInterfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\RepositoryInterfaces\CartRepositoryInterface;
use App\Repositories\RepositoryInterfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(ProductRepositoryInterface::class, ProductRepository::class);
        app()->bind(CartRepositoryInterface::class, CartRepository::class);
        app()->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
