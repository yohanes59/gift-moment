<?php

namespace App\Http\Controllers;

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
}