<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $products = Product::paginate(8);
        $faq = Faq::get();

        return view('customer.home.index', compact('categories', 'products','faq'));
    }

    public function showProductByCategory(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('categories_id', $category->id)->paginate(8);
        $faq = Faq::get();

        return view('customer.home.index', compact('categories', 'products','faq'));
    }

    public function search(Request $request)
    {
        $categories = Category::get();
        $faq = Faq::get();

        $search = $request->search;

        $products = Product::where('name','LIKE','%'.$search.'%')->paginate(8);

        return view('customer.home.index', compact('categories', 'products','faq'));
    }
    
}
