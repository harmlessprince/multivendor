<?php

namespace App\Providers;

use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\RepositoryInterfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\RepositoryInterfaces\CartRepositoryInterface;
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
