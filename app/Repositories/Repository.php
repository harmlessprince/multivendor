<?php

namespace App\Repositories;

use Illuminate\Database\Query\Builder;

abstract class Repository
{
    protected Builder $query;

    public function __construct($query)
    {
        $this->$query = $query;
    }

    public function all()
    {
        return $this->query->get();
    }
}
