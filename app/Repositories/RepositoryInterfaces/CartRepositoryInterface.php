<?php

namespace App\Repositories\RepositoryInterfaces;

interface CartRepositoryInterface 
{
    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function add($productId);
}