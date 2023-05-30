<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->session()->get('checkout_data');
        return view('customer.cart.checkout', compact('data'));
    }
}
