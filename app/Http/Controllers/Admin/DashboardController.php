<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::count();
        $sales = Transaction::sum('total');
        $profits = TransactionDetail::sum('profit');

        return view('admin.dashboard.index', compact('transactions', 'sales', 'profits'));
    }
}
