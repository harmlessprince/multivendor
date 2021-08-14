<?php

namespace App\Repositories\RepositoryInterfaces;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function setModel();

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all();


    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show($product);


}
