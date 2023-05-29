<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
}
