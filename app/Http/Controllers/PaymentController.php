<?php

namespace App\Http\Controllers;

use App\Repositories\PaystackRepository;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController
{
    private $paystackRepo;
    public function __construct(PaystackRepository $paystackRepository)
    {
        $this->paystackRepo = $paystackRepository;
        # code...
    }
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        
      return $this->paystackRepo->prepareTransaction();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
