<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    public function index()
    {
        $AdminId = User::where('roles', 'Admin')->first()->id;
        $data = UserDetail::with('user')
            ->whereNotIn('users_id', [$AdminId])
            ->paginate(10);

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

        $userDetails = $data->map(function ($detail) use ($provinces, $cities) {
            $provinceName = null;
            $cityName = null;

            foreach ($provinces as $province) {
                if ($province['province_id'] == $detail->provinces_id) {
                    $provinceName = $province['province'];
                    break;
                }
            }

            foreach ($cities as $city) {
                if ($city['city_id'] == $detail->city_id) {
                    $cityName = $city['city_name'];
                    break;
                }
            }

            return [
                'users_id' => $detail->users_id,
                'cityName' => $cityName,
                'provinceName' => $provinceName
            ];
        });

        return view('admin.customers.index', compact('data', 'userDetails'));
    }
}
