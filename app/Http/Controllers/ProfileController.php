<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function address($id)
    {
        $data = UserDetail::where('users_id', $id)->first();

        $responseProvince = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->get(config('rajaongkir.province_url'));

        $responseCity = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->get(config('rajaongkir.city_url'));

        $provinces = $responseProvince['rajaongkir']['results'];
        $cities = $responseCity['rajaongkir']['results'];

        return view('customer.cart.address', compact('provinces', 'cities', 'data'));
    }

    public function editProfile($id)
    {
        $data = UserDetail::where('users_id', $id)->first();

        $responseProvince = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->get(config('rajaongkir.province_url'));

        $responseCity = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->get(config('rajaongkir.city_url'));

        $provinces = $responseProvince['rajaongkir']['results'];
        $cities = $responseCity['rajaongkir']['results'];

        return view('customer.profile.edit.index', compact('provinces', 'cities', 'data'));
    }

    public function saveProfile(ProfileRequest $request)
    {
        $data = $request->all();
        $userId = $request->id;
        unset($data['id']);
        UserDetail::updateOrCreate(['users_id' => $userId], $data);
        return back()->with('info', 'Data Berhasil Diperbarui!');
    }
}
