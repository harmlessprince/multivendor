<?php

namespace App\Repositories;;

use Darryldecode\Cart\Facades\CartFacade;
use App\Repositories\Contracts\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function setModel()
    {
        return CartFacade::session(auth()->id());
    }
    public function add($product)
    {
        return $this->setModel()->add(array(
            'id' => uniqid($product->id),
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product,
        ));
    }

    /**
     * update a cart
     *
     * @param $id (the item ID)
     * @param array $data
     *
     * the $data will be an associative array, you don't need to pass all the data, only the key value
     * of the item you want to update on it
     */
    public function update($request, $id)
    {
        return  $this->setModel()->update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity,
            ),
        ));
    }

    public function remove($productId)
    {
        return $this->setModel()->remove($productId);
    }

    public function clearCart()
    {
        return $this->setModel()->clear();
    }

    public function cartIsEmpty()
    {
    }

    public function getContent()
    {
        return  $this->setModel()->getContent();
    }

    public function getTotalQuantity()
    {
        return $this->setModel()->getTotalQuantity();
    }
    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function getTotal()
    {
        return $this->setModel()->getTotal();
    }

    public function getSubtotal()
    {
    }
}
