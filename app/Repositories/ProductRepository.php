<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\RepositoryInterfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
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

    public function show($product)
    {
        return  $this->model::findOrFail($product);
    }

    public function setModel()
    {
        return Product::class;
    }
}
