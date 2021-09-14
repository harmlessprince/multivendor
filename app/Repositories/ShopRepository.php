<?php

namespace App\Repositories;;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ShopRepositoryInterface;

class ShopRepository extends BaseRepository {

    /**
     * @var Model
     */
    protected $model;
    /**
     * BaseRepository Constructor
     * @param Model $model
     */
    public function __construct(Shop $model)
    {
        $this->model = $model;
    }
     /**
     * Create a model.
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function userHasShop()
    {
        if (auth()->user()->has('shop')) {
            return true;
         }
    }
}
