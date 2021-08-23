<?php

namespace App\Repositories;;

use App\Models\PaymentMethod;
use App\Repositories\Contracts\PaymentMethodRepositoryInterface;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{

    protected $model;
    public function __construct()
    {
        $this->model = $this->setModel();
    }

    public function all()
    {
        return  $this->model::all();
    }
    public function setModel()
    {
        return PaymentMethod::class;
    }
}
