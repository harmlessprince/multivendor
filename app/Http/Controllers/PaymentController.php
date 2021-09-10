<?php

namespace App\Http\Controllers;

use App\Events\OrderPaidEvent;
use App\Repositories\OrderRepository;
use App\Repositories\PaystackRepository;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController
{
    private $paystackRepo;
    private $orderRepo;
    public function __construct(PaystackRepository $paystackRepository, OrderRepository $orderRepository)
    {
        $this->paystackRepo = $paystackRepository;
        $this->orderRepo = $orderRepository;
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
        $paymentDetail = Paystack::getPaymentData();
        if ($paymentDetail['status'] && $paymentDetail['data']['status'] == 'success') {
            $order_number = $paymentDetail['data']['reference'];
            $order =  $this->orderRepo->findByOrderNumber($order_number);
            if (!$order) {
                return redirect('/')->with(['error' => 'Payment unsuccessful, Something went wrong ']);
            }
            $this->orderRepo->update($order->id, [
                'is_paid' => true,
                'payment_method_id' => 1,
            ]);
            //send mail
            event(new OrderPaidEvent($order));
            return redirect('/')->with(['success' => 'Payment successful']);
        }
        return redirect('/')->with(['error' => 'Payment unsuccessful, Something went wrong ']);
    }
}
