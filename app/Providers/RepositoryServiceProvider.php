<?php

namespace App\Providers;

use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\PaystackRepository;
use App\Repositories\RepositoryInterfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\RepositoryInterfaces\CartRepositoryInterface;
use App\Repositories\RepositoryInterfaces\OrderRepositoryInterface;
use App\Repositories\RepositoryInterfaces\PaymentMethodRepositoryInterface;
use App\Repositories\RepositoryInterfaces\PaystackRepositoryInterface;
use Facade\FlareClient\Http\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
        app()->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
        $this->app->singleton(PaystackRepositoryInterface::class, function ($app) {
            return new PaystackRepository(
                Config::get('paystack.secretKey'),
                Config::get('paystack.paymentUrl'),
                $this->setRequestOptions()
            );
        });
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

    /**
     * Set options for making the Client request
     */
    private function setRequestOptions()
    {
        $authBearer = 'Bearer ' .  Config::get('paystack.secretKey');
        return new Client(
            Config::get('paystack.paymentUrl'),
            $authBearer
        );
    }
}
