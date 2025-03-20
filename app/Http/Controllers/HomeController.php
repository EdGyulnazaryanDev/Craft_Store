<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductServiceInterface;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::active()->get();
        return view('home', compact('products'));
    }
}
