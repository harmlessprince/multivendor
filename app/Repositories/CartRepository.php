<?php

namespace App\Repositories;;

use App\Repositories\RepositoryInterfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{

/**
     * Get's all posts.
     *
     * @return mixed
     */
    public function add($productId)
    {
        return $productId;
    }
}
