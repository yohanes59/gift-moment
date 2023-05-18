<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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
        $responseProvince = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->get(config('rajaongkir.province_url'));

        $responseCity = Http::withHeaders([
            'key' => config('rajaongkir.key')
        ])->get(config('rajaongkir.city_url'));

        $provinces = $responseProvince['rajaongkir']['results'];
        $cities = $responseCity['rajaongkir']['results'];
        
        return view('admin.profile.form', compact('provinces', 'cities'));
    }

    public function saveProfile(Request $request)
    {
        $data = $request->all();
        dd($data);
    }
}
