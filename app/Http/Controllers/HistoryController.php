<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;

class HistoryController extends Controller
{
    public function index()
    {
        $data = Transaction::where('users_id', auth()->id())->get();
        $payment = Payment::whereIn('transactions_id', $data->pluck('id'))->get();

        return view('customer.profile.riwayat.index', compact('data', 'payment'));
    }

    public function show($id)
    {
        $data = TransactionDetail::where('transactions_id', $id)->get();

        return view('customer.profile.riwayat.detail', compact('data'));
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
