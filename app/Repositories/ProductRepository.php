<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;
    /**
     * BaseRepository Constructor
     * @param Model $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
