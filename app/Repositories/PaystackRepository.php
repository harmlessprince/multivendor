<?php

namespace App\Repositories;;

use App\Repositories\RepositoryInterfaces\PaystackRepositoryInterface;

class PaystackRepository implements PaystackRepositoryInterface
{


    public function __construct($secretKey, $baseUrl, $requestOptions)
    {
        
    }

    public function prepareTransaction($amount, $destination, $info = null)
    {
    }

    public function verify($refernce)
    {
    }
}
