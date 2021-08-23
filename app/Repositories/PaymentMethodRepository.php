<?php

namespace App\Repositories;;

use App\Models\PaymentMethod;
use App\Repositories\Contracts\PaymentMethodRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;
    /**
     * BaseRepository Constructor
     * @param Model $model
     */
    public function __construct(PaymentMethod $model)
    {
        $this->model = $model;
    }
}
