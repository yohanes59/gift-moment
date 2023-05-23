<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ProfileRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::count();
        $sales = Transaction::sum('total');
        $profits = TransactionDetail::sum('profit');

        return view('admin.dashboard.index', compact('transactions', 'sales', 'profits'));
    }

    public function editProfile()
    {
        $item = UserDetail::whereHas('user', function ($query) {
            $query->where('roles', 'Admin');
        })->first();

        $responseProvince = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->get(config('rajaongkir.province_url'));

        $responseCity = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->get(config('rajaongkir.city_url'));

        $provinces = $responseProvince['rajaongkir']['results'];
        $cities = $responseCity['rajaongkir']['results'];

        return view('admin.profile.form', compact('provinces', 'cities', 'item'));
    }

    public function saveProfile(ProfileRequest $request)
    {
        $data = $request->all();
        $userId = User::where('roles', 'Admin')->first()->id;
        UserDetail::updateOrCreate(['users_id' => $userId], $data);
        return back()->with('info', 'Data Berhasil Diperbarui!');
    }
}
