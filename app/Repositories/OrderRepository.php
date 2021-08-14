<?php

namespace App\Repositories;;

use App\Models\Order;
use App\Repositories\RepositoryInterfaces\OrderRepositoryInterface;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements OrderRepositoryInterface
{
    const ORDER_STATUS_DEFAULT = 1; //PENDING
    const ORDER_PAYMENT_METHOD_DEFAULT = 2; //CASH
    protected $model;
    public function __construct()
    {
        $this->model = $this->setModel();
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
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
        $order->grand_total = CartFacade::session(auth()->id())->getTotal();
        $order->item_count =  CartFacade::session(auth()->id())->getTotalQuantity();
        $order->save();
        return $order;
    }


    public function setModel()
    {
        return Order::class;
    }
}
