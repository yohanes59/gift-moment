<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Product;
use App\Models\TransactionDetail;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Transaction::with('user')
                ->whereNull('order_status')
                ->orWhereIn('order_status', ['NEW_ORDER', 'PACKED', 'SHIPPED', 'COMPLETED'])
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
        return view('admin.transaction.index');
    }

    public function updateStatus($id)
    {
        // data transaksi
        $data = Transaction::with('user')->where('id', $id)->first();
        // data detail transaksi yang id transaksinya sama dengan id transaksi di atas
        $detail = TransactionDetail::where('transactions_id', $data->id)->get();
        // ambil data product id dan qty nya dari data diatas dan gabungkan ke dalam array
        $detailData = $detail->map(function ($item) {
            return [
                'product_id' => $item->products_id,
                'qty' => $item->qty,
            ];
        });

        if ($data->payment_status == 'UNPAID') {
            $data->update([
                'payment_status' => 'PAID',
                'order_status' => 'NEW_ORDER'
            ]);
            // buat data stock kolom outcoming_stock dengan data qty dari detail transaksi
            foreach ($detailData as $item) {
                Stock::create([
                    'products_id' => $item['product_id'],
                    'outcoming_stock' => $item['qty']
                ]);

                $product = Product::find($item['product_id']);
                $product->stock_amount -= $item['qty'];
                $product->save();
            }
        } else {
            if ($data->order_status == 'NEW_ORDER') {
                $data->update([
                    'order_status' => 'PACKED'
                ]);
            } elseif ($data->order_status == 'PACKED') {
                $data->update([
                    'order_status' => 'SHIPPED'
                ]);
            }
        }

        return back();
    }

    public function cancelOrderNotPay($id)
    {
        $data = Transaction::with('user')->where('id', $id)->first();
        $data->update([
            'payment_status' => 'CANCELLED',
            'order_status' => 'CANCELLED'
        ]);

        return back();
    }

    public function getPayment($id)
    {
        $paymentData = Payment::where('transactions_id', $id)->first();
        return view('admin.transaction.payment', compact('paymentData'));
    }
}
