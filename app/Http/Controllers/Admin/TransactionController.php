<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        // $item = Transaction::with('user')->get();
        if (request()->ajax()) {
            $query = Transaction::with('user')->get();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
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
                })
                ->rawColumns(['action'])
                ->make();
        }
        // return view('admin.transaction.index', compact('item'));
        return view('admin.transaction.index');
    }
}
