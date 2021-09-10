<?php

namespace App\Repositories\Contracts;

interface PaystackRepositoryInterface
{
    /**
     * Prepare a transaction for payment
     *
     * @return void
     */
    public function prepareTransaction();
    
    /**
     * Verify a payment transaction
     *
     * @return void
     */
    public function verify($refernce);
}
