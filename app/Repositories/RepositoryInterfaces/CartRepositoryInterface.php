<?php

namespace App\Repositories\RepositoryInterfaces;

use Symfony\Component\HttpFoundation\Request;

interface CartRepositoryInterface
{
    /**
     * add item to the cart, it can be an array or multi dimensional array
     *
     * @param string|array $id
     * @param string $name
     * @param float $price
     * @param int $quantity
     * @param array $attributes
     * @param CartCondition|array $conditions
     * @return $this
     * @throws InvalidItemException
     */
    public function add($item);

    public function update(Request $request, $id);
    /**
     * removes an item on cart by item ID
     *
     * @param $id
     */
    public function remove($id);
    /**
     * clear cart
     *
     * @return void
     */
    public function clearCart();
    /**
     * check if cart is empty
     *
     * @return bool
     */
    public function cartIsEmpty();
    /**
     * get the cart
     *
     * @return CartCollection
     */
    public function getContent();
    /**
     * get total quantity of items in the cart
     *
     * @return int
     */
    public function getTotalQuantity();

    /**
     * the new total in which conditions are already applied
     *
     * @return float
     */
    public function getTotal();

    /**
     * get cart sub total
     *
     * @return float
     */
    public function getSubtotal();
    // public function add($productId);

}
