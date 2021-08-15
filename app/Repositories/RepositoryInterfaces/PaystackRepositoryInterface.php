<?php

namespace App\Repositories\RepositoryInterfaces;

interface PaystackRepositoryInterface
{
    /**
     * Prepare a transaction for payment
     *
     * @return void
     */
    public function prepareTransaction($amount, $destination, $info = null);
    
    /**
     * Verify a payment transaction
     *
     * @return void
     */
    public function verify($refernce);
}
