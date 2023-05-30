<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // kalau belum login, harus login dulu
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cart = Cart::with('product.category')->where('users_id', auth()->id())->get();
        return view('customer.cart.index2', compact('cart'));
    }

    public function destroy(Request $request, $id)
    {
        $cart = Cart::where('users_id', auth()->id())->findOrFail($id);
        $cart->delete();
        return back();
    }

    public function getCartData(Request $request)
    {
        $data = $request->all();
        $data['users_id'] = auth()->id();

        // gabungkan data qty ke dalam array sesuai dengan product_id nya
        $products_qty = array_combine($data['products_id'], $data['qty']);

        $products = Product::whereIn('id', $data['products_id'])->get();

        $checkout_data = [];

        foreach ($products as $product) {
            $checkout_data[$product->id] = [
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_capital_price' => $product->capital_price,
                'product_image' => $product->image,
                'qty' => $products_qty[$product->id],
                'sub_total' => $products_qty[$product->id] * $product->price,
                'total_weight' => $products_qty[$product->id] * $product->weight,
                'total_profit' => ($product->price - $product->capital_price) * $products_qty[$product->id],
            ];
        }

        $data['checkout_data'] = $checkout_data;
        unset($data['products_id']);
        unset($data['qty']);
        $request->session()->put('checkout_data', $data);

        return redirect('/checkout');
    }
}
