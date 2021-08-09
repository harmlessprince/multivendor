<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\RepositoryInterfaces\ProductInterface;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductInterface
{

    public function __construct()
    {
        // $this->model = app()->make($this->model());
    }

    public function all()
    {
        return Product::all();
    }
}
