<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class HistoryStockController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Stock::with('product');

            // Mengambil tanggal awal dan akhir dari request
            $startDate = request()->input('start_date');
            $endDate = request()->input('end_date');

            // Filter berdasarkan range tanggal jika ada
            if ($startDate && $endDate) {
                $startDateTime = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
                $endDateTime = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();

                $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
            }

            return DataTables::eloquent($query)
                ->editColumn('image', function ($item) {
                    return $item->product->image ? '<img src="' . Storage::url($item->product->image) . '" style="height: 60px; width: 60px;"/>' : '';
                })
                ->rawColumns(['image'])
                ->make(true);
        }

        return view('admin.stock.history.index');
    }
}
