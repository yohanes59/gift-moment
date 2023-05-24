<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $products = Product::paginate(8);

        return view('customer.home.index', compact('categories', 'products'));
    }

    public function showProductByCategory(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('categories_id', $category->id)->paginate(8);

        return view('customer.home.index', compact('categories', 'products'));
    }
    
}
