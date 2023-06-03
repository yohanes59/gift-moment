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
}
