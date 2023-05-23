<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $product = Product::with('category')->where('slug', $id)->firstOrFail();
        return view('customer.product.detail', compact('product'));
    }
}
