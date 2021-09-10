<?php

namespace App\Repositories;;

use App\Services\TransactionRef;
use App\Exceptions\IsNullException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;
use App\Repositories\Contracts\PaystackRepositoryInterface;

class PaystackRepository implements PaystackRepositoryInterface
{

    public function __construct()
    {
    }


    public function prepareTransaction()
    {
        try {
            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }
    /**
     * Hit Paystack Gateway to Verify that the transaction is valid
     */
    public function verify($refernce)
    {

    }
}
