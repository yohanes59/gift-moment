<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Stock;
use App\Models\Payment;
use App\Models\Product;
use App\Models\UserDetail;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ProfileRequest;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $transactionsID = Transaction::where('payment_status', 'PAID')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->pluck('id');

        $transactions = Transaction::where('payment_status', 'PAID')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        $sales = Transaction::where('payment_status', 'PAID')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('total');
        $profits = TransactionDetail::whereIn('transactions_id', $transactionsID)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('profit');
        $bestSellingProducts = Stock::with('product')
            ->selectRaw('products_id, sum(outcoming_stock) as total_outcoming_stock')
            ->where('outcoming_stock', '>', 0)
            ->groupBy('products_id')
            ->orderByDesc('total_outcoming_stock')
            ->take(5)
            ->get();
        $stockAlerts = Product::with('category')->where('stock_amount', '<=', 10)->paginate(5);

        if (request()->ajax()) {
            $query = Transaction::with('user')
                ->whereNull('order_status')
                ->orWhereIn('order_status', ['NEW_ORDER', 'PACKED', 'SHIPPED'])
                ->orderByDesc('created_at')
                ->get();

            return DataTables::of($query)
                ->addColumn('order_status', function ($item) {
                    $payment = Payment::where('transactions_id', $item->id)->first();
                    if ($item->order_status === 'CANCELLED') {
                        return 'Pesanan Tidak Dibayar';
                    } elseif ($item->order_status == null && isset($payment)) {
                        return 'Menunggu Konfirmasi Pembayaran';
                    } elseif ($item->order_status == null && !isset($payment)) {
                        return 'Menunggu Pembayaran Customer';
                    } else {
                        return $item->order_status;
                    }
                })
                ->addColumn('action', function ($item) {
                    $payment = Payment::where('transactions_id', $item->id)->first();
                    if ($item->payment_status == 'CANCELLED') {
                        return '
                            <td class="py-3 px-6">
                                <div class="flex items-center space-x-2">
                                    <a href="/admin/transaction/' . $item->id . '/show"
                                    class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600" data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </div>
                            </td>
                        ';
                    } elseif ($item->payment_status == 'UNPAID' && !isset($payment)) {
                        return '
                            <td class="py-3 px-6">
                                <div class="flex items-center space-x-2">
                                    <a href="/admin/transaction/' . $item->id . '/show"
                                    class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600" data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                    <a href="/admin/transaction/' . $item->id . '/cancel-order"
                                    class="py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600" data-bs-toggle="tooltip-detail" data-bs-title="Batalkan Pesanan"  onclick="return confirm(&quot;Yakin Ingin Membatalkan Pesanan Ini?&quot;)">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                </div>
                            </td>
                        ';
                    } elseif ($item->payment_status == 'UNPAID' && isset($payment)) {
                        return '
                            <td class="py-3 px-6">
                                <div class="flex items-center space-x-2">
                                    <a href="/admin/transaction/' . $item->id . '/show"
                                    class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600" data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                    <a href="/admin/transaction/' . $item->id . '/show-payment"
                                    class="py-2 px-3 rounded-md text-white bg-yellow-500 hover:bg-yellow-600" data-bs-toggle="tooltip-detail" data-bs-title="Cek Bukti Pembayaran">
                                    <i class="fa-solid fa-receipt"></i>
                                    </a>
                                    <a href="/admin/transaction/' . $item->id . '/update-status"
                                    class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600" data-bs-toggle="tooltip-detail" data-bs-title="Ubah Status Pesanan" onclick="return confirm(&quot;Bukti pembayaran sudah valid? ubah status pesanan untuk diproses&quot;)">
                                        <i class="fa-solid fa-check"></i>
                                    </a>
                                    <a href="/admin/transaction/' . $item->id . '/cancel-order"
                                    class="py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600" data-bs-toggle="tooltip-detail" data-bs-title="Batalkan Pesanan"  onclick="return confirm(&quot;Yakin Ingin Membatalkan Pesanan Ini?&quot;)">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                </div>
                            </td>
                        ';
                    } elseif ($item->order_status == 'NEW_ORDER') {
                        return '
                            <td class="py-3 px-6">
                            <div class="flex items-center space-x-2">
                                <a href="/admin/transaction/' . $item->id . '/show"
                                class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600" data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                                <a href="/admin/transaction/' . $item->id . '/update-status"
                                class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600" data-bs-toggle="tooltip-detail" data-bs-title="Ubah Status Pesanan" onclick="return confirm(&quot;Paket sudah siap dikemas? Ubah status menjadi dikemas&quot;)">
                                    <i class="fa-solid fa-box"></i>
                                </a>
                            </div>
                        </td>
                        ';
                    } elseif ($item->order_status == 'PACKED') {
                        return '
                            <td class="py-3 px-6">
                            <div class="flex items-center space-x-2">
                                <a href="/admin/transaction/' . $item->id . '/show"
                                class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600" data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                                <a href="/admin/transaction/' . $item->id . '/update-status"
                                class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600" data-bs-toggle="tooltip-detail" data-bs-title="Ubah Status Pesanan" onclick="return confirm(&quot;Paket sudah selesai dikemas dan sudah diambil kurir? Ubah status menjadi dikirim&quot;)">
                                    <i class="fa-solid fa-truck-fast"></i>
                                </a>
                            </div>
                        </td>
                        ';
                    } else {
                        return '
                                <td class="py-3 px-6">
                                <div class="flex items-center space-x-2">
                                    <a href="/admin/transaction/' . $item->id . '/show"
                                    class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600" data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </div>
                            </td>
                            ';
                    }
                })
                ->rawColumns(['order_status', 'action'])
                ->make();
        }
        return view('admin.dashboard.index', compact('transactions', 'sales', 'profits', 'stockAlerts', 'bestSellingProducts'));
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
