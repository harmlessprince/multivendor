<?php

namespace App\Repositories\RepositoryInterfaces;

interface OrderRepositoryInterface 
{
    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all();
     /**
     * store order.
     *
     * @return mixed
     */
    public function storeOrder($data);
}