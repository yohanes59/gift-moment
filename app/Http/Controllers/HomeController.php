<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::get();
        $category = Category::get();

        return view('customer.home.index', ['product' => $product, 'category' => $category]);
    }
    
}
