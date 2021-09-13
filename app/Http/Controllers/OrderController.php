<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\OrderStatusRepositoryInterface;

class OrderController extends Controller
{
    protected $orderRepo;
    protected $orderStatusRepo;
    public function __construct(OrderRepositoryInterface $orderRepo, OrderStatusRepositoryInterface $orderStatusRepository)
    {
        $this->orderRepo = $orderRepo;
        $this->orderStatusRepo = $orderStatusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepo->all();
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        $validatedData = $request->validated();
        $res = $this->orderRepo->storeOrder($validatedData);
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order_statuses = $this->orderStatusRepo->all();
        return view('order.show', compact('order', 'order_statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order_statuses = $this->orderStatusRepo->all();
        return view('order.edit', compact('order', 'order_statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->only(['is_paid', 'order_status_id']);
        $this->orderRepo->update($order->id, $data);

        return redirect()->route('orders.show', $order)->with(['success'=>'Order updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $this->orderRepo->deleteById($order->id);
        return back()->with(['success' => 'Order Deleted Successfully']);
    }
}
