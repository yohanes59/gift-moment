<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\UserDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
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

        return view('customer.cart.checkout', compact('data', 'userDetailData', 'provinceName', 'cityName'));
    }

    public function payNow(Request $request)
    {
        $data = $request->session()->get('checkout_data');

        $transaction = Transaction::create([
            'users_id' => auth()->id(),
            'total' => $data['total'],
            'courier' => $data['shipping']['courier_code'] . ' - ' . $data['shipping']['service'],
            'shipping_costs' => $data['shipping']['shipping_costs'],
            'payment_status' => 'UNPAID',
            'order_status' => null
        ]);

        foreach ($data['checkout_data'] as $productID => $productData) {
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $productID,
                'product_name' => $productData['product_name'],
                'product_image' => $productData['product_image'],
                'product_price' => $productData['product_price'],
                'product_capital_price' => $productData['product_capital_price'],
                'qty' => $productData['qty'],
                'profit' => $productData['total_profit'],
                'sub_total' => $productData['sub_total'],
                'weight' => $productData['total_weight']
            ]);
        }

        $cart = Cart::where('users_id', auth()->id());
        $cart->delete();
        $request->session()->forget('checkout_data');
        return redirect('/success-order');
    }
}
