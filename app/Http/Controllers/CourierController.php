<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CourierController extends Controller
{
    public function index(Request $request)
    {
        $ongkir = null;
        $data = $request->session()->get('checkout_data');

        return view('customer.cart.courier', compact('ongkir', 'data'));
    }

    public function cekOngkir(Request $request)
    {
        $validatedData = $request->validate([
            'courier' => 'required|in:jne,pos,tiki'
        ]);
        
        $data = $request->session()->get('checkout_data');
        $sellerId = User::where('roles', 'Admin')->first()->id;
        $sellerDetailData = UserDetail::where('users_id', $sellerId)->first();
        $userDetailData = UserDetail::where('users_id', auth()->user()->id)->first();

        $origin = $sellerDetailData->city_id;
        $destination = $userDetailData->city_id;
        $weight = 0;
        foreach ($data['checkout_data'] as $item) {
            $weight += $item['total_weight'];
        }

        $responseCost = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->post(config('rajaongkir.cost_url'), [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $request->courier,
        ]);

        $ongkir = $responseCost['rajaongkir'];

        return view('customer.cart.courier', compact('data', 'ongkir'));
    }

    public function getOngkir(Request $request)
    {
        $data = $request->session()->get('checkout_data');
        $courierData = $request->all();
        $service_array = explode(',', $courierData['service'][0]);
        // dd($service_array);

        $data['shipping'] = [
            'courier_code' => $courierData['courier_code'],
            'courier_name' => $courierData['courier_name'],
            'service' => $service_array[0],
            'shipping_costs' => $service_array[1],
            'estimated_time' => $service_array[2],
        ];

        $request->session()->put('checkout_data', $data);
        return redirect('/checkout');
    }
}
