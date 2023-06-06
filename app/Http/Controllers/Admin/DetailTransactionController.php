<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\TransactionDetail;

class DetailTransactionController extends Controller
{
    public function show($id)
    {
        $detailTransaction = TransactionDetail::with(['product.category', 'transaction.user'])->where('transactions_id', $id)->get();
        $paymentData = Payment::where('transactions_id', $id)->first();
        return view('admin.transaction.detail', compact('detailTransaction', 'paymentData'));
    }
}
