<?php

namespace App\Repositories;;
use App\Models\Shop;
use App\Repositories\Contracts\ShopRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
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
}
