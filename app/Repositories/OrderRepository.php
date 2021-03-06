<?php

namespace App\Repositories;;

use App\Models\Order;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Database\Eloquent\Model;
use Unicodeveloper\Paystack\Facades\Paystack;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    const ORDER_STATUS_DEFAULT = 1; //PENDING
    const ORDER_PAYMENT_METHOD_DEFAULT = 2; //CASH
    protected $model;
    protected $cartRepo;
    private $paystackRepo;

    public function __construct(CartRepositoryInterface $cartRepo, PaystackRepository $paystackRepository, Order $model)
    {
        $this->cartRepo = $cartRepo;
        $this->paystackRepo = $paystackRepository;
        $this->model = $model;
    }



    public function storeOrder($data)
    {
        $order = new Order();
        $order->shipping_fullname = $data['shipping_fullname'];
        $order->shipping_address = $data['shipping_address'];
        $order->shipping_city = $data['shipping_city'];
        $order->shipping_state = $data['shipping_state'];
        $order->shipping_zipcode = $data['shipping_zipcode'];
        $order->shipping_phone = $data['shipping_phone'];

        if (!$order['billing_fullname']) {
            $order->billing_fullname = $data['shipping_fullname'];
            $order->billing_address = $data['shipping_address'];
            $order->billing_city = $data['shipping_city'];
            $order->billing_state = $data['shipping_state'];
            $order->billing_zipcode = $data['shipping_zipcode'];
            $order->billing_phone = $data['shipping_phone'];
        }
        $order->user_id = auth()->id();
        $order->order_status_id = self::ORDER_STATUS_DEFAULT;
        $order->payment_method_id = self::ORDER_PAYMENT_METHOD_DEFAULT;
        $order->order_number = uniqid('ORDER-NUMBER-');
        $order->grand_total = $this->cartRepo->getTotal();
        $order->item_count =  $this->cartRepo->getTotalQuantity();
        $order->save();
        //save order items
        $cartItems = $this->cartRepo->getContent();
        $cartItems->each(function ($cartItem, $key) use ($order) {
            $order->items()->attach($cartItem->associatedModel->id, ['price' => $cartItem->price, 'quantity' => $cartItem->quantity]);
        });
        //empty cart
        $this->cartRepo->clearCart();
        if ($data['payment_method'] != self::ORDER_PAYMENT_METHOD_DEFAULT) {
            //redirect to paystack
            request()->merge([
                'amount' => $order->grand_total * 100,
                'reference' => $order->order_number,
                'email' => auth()->user()->email,
            ]);
            return  $this->paystackRepo->prepareTransaction();
        }
        //send email customer

        //take user to thank you
        return redirect('/')->with(['success' => 'Order Completed, thank you for your order']);
    }


    public function setModel()
    {
        return Order::class;
    }

    public function findByOrderNumber($order_number)
    {
        return $this->model->where('order_number', $order_number)->first();
    }
}
