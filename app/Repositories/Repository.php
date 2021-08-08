<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

abstract class Repository
{
    private $model;

    public function __construct(Model $model)
    {
        $this->$model = $model;
    }

    abstract function model();
   
    public function all()
    {
        return $this->model::all();
    }
}
