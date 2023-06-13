<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{
    public function index()
    {
        $data = Transaction::where('users_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(5);
        $payment = Payment::whereIn('transactions_id', $data->pluck('id'))->get();
        $userData = UserDetail::whereHas('user', function ($query) {
            $query->where('roles', 'Admin');
        })->first();

        return view('customer.profile.riwayat.index', compact('data', 'payment', 'userData'));
    }

    public function show($id)
    {
        // untuk alamat
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

        $provinceName = null;
        $cityName = null;
        if ($userDetailData) {
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
        }

        $courier = Transaction::where('id', $id)->get();
        $data = TransactionDetail::where('transactions_id', $id)->get();
        return view('customer.profile.riwayat.detail', compact('data', 'courier', 'userDetailData', 'provinceName', 'cityName'));
    }

    public function confirmOrderStatus($id)
    {
        $data = Transaction::with('user')->where('id', $id)->first();
        $data->update([
            'order_status' => 'COMPLETED'
        ]);

        return back();
    }
}
