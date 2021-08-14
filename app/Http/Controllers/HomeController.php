<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryInterfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    protected $productRepo;
    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function index()
    {
        $products = $this->productRepo->all()->take(10);
        return view('welcome', compact('products'));
    }
}
