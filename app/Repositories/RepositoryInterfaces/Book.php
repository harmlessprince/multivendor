<?php

namespace App\Repositories\RepositoryInterfaces;

interface BookRepositoryInterface 
{
    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all();
}