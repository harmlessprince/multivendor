<?php

namespace App\Repositories;

use App\Models\OrderStatus;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\OrderStatusRepositoryInterface;

class OrderStatusRepository extends BaseRepository implements OrderStatusRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;
    /**
     * BaseRepository Constructor
     * @param Model $model
     */
    public function __construct(OrderStatus $model)
    {
        $this->model = $model;
    }
}
