<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->session()->get('checkout_data');
        $userDetailData = UserDetail::where('users_id', auth()->user()->id)->first();

        $responseProvince = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->get(config('rajaongkir.province_url'));

        $responseCity = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->get(config('rajaongkir.city_url'));

        $provincesArray = $responseProvince->json();
        $cityArray = $responseCity->json();

        $provinces = $provincesArray['rajaongkir']['results'];
        $cities = $cityArray['rajaongkir']['results'];

        foreach ($provinces as $province) {
            if ($province['province_id'] == $userDetailData->provinces_id) {
                $provinceName = $province['province'];
                break;
            }
        }

        foreach ($cities as $city) {
            if ($city['city_id'] == $userDetailData->city_id) {
                $cityName = $city['city_name'];
                break;
            }
        }

        return view('customer.cart.checkout', compact('data', 'userDetailData', 'provinceName', 'cityName'));
    }


    public function courier(Request $request)
    {
        $ongkir = null;
        $data = $request->session()->get('checkout_data');

        return view('customer.cart.courier', compact('ongkir', 'data'));
    }

    public function cekOngkir(Request $request)
    {
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

        // dd($courierData);

        $data['shipping'] = [
            'courier_code' => $courierData['courier_code'],
            'courier_name' => $courierData['courier_name'],
            'service' => $courierData['service'],
            'shipping_costs' => $courierData['shipping_costs'],
            'estimated_time' => $courierData['estimated_time'],
        ];

        // dd($data);

        $request->session()->put('checkout_data', $data);
        return redirect('/checkout');
    }
}
