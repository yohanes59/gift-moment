<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->session()->get('checkout_data');
        $userDetailData = UserDetail::where('users_id', auth()->user()->id)->first();
        return view('customer.cart.checkout', compact('data', 'userDetailData'));
    }
}
