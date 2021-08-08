<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class ProductRepository extends Repository
{

    public function __construct($model)
    {
        $this->query = $model->query();
    }
}
