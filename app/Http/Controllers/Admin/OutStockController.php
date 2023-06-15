<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class OutStockController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Stock::with('product')->where('outcoming_stock', '>', 0);

            return DataTables::of($query)
                ->editColumn('image', function ($item) {
                    return $item->product->image ? '<img src="' . Storage::url($item->product->image) . '" style="height: 60px; width: 60px;"/>' : '';
                })
                ->rawColumns(['image'])
                ->make();
        }
        return view('admin.stock.keluar.index');
    }
}
