<?php

namespace App\Http\Controllers;

use App\Repositories\CartRepository;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\PaymentMethodRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{

    //
    protected $cartRepo;
    protected $productRepo;
    protected $paymentMethodRepo;
    public function __construct(CartRepository $cartRepo, ProductRepositoryInterface $productRepo, PaymentMethodRepositoryInterface $paymentMethodRepo)
    {
        $this->cartRepo = $cartRepo;
        $this->productRepo = $productRepo;
        $this->paymentMethodRepo = $paymentMethodRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = $this->cartRepo->getContent();
        return view('cart.index', compact('cartItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $product = $this->productRepo->show($id);
        $this->cartRepo->add($product);
        return redirect()->route('cart.index');
    }

    /**
     * Display the checkout view.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $paymentMethods = $this->paymentMethodRepo->all();
        return view('cart.checkout', compact('paymentMethods'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->cartRepo->update($request, $id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cartRepo->remove($id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        $this->cartRepo->clearCart();
        return back();
    }
}
