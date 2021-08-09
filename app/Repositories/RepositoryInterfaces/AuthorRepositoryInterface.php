<?php

namespace App\Repositories\RepositoryInterfaces;

interface AuthorRepositoryInterface 
{
    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all();
}