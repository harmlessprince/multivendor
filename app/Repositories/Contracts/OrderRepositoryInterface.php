<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface extends EloquentRepositoryInterface
{
   
    public function storeOrder($data);
}