<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $product = Product::with('category')->where('slug', $id)->firstOrFail();
        return view('customer.product.detail', compact('product'));
    }

    public function add(Request $request, $id)
    {
        // kalau belum login, harus login dulu
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // cari product berdasarkan id
        $productID = $id;
        $product = Product::findOrFail($productID);

        $data = [
            'product_name' => $product->name,
            'product_image' => $product->image,
            'product_price' => $product->price,
            'users_id' => Auth::user()->id,
            'qty' => $request->product_qty,
            'weight' => $product->weight,
            'product_capital_price' => $product->capital_price,
        ];

        // dd($data);

        // kalau sudah ada data di cart, maka update data
        $cart = Cart::where('product_name', $product->name)
            ->where('users_id', auth()->id())
            ->first();
        // dd($cart);
        if ($cart) {
            $data['qty'] = $cart->qty + $request->product_qty;
            $cart->update($data);
        } else {
            // kalau belum ada data di cart, maka create data baru
            Cart::create($data);
        }

        return redirect('/cart');
    }
}
