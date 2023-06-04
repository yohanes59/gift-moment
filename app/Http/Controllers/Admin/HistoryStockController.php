<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class HistoryStockController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Stock::with('product');

            $incomingStockFilter = $request->input('incoming_stock');
            $outcomingStockFilter = $request->input('outcoming_stock');

            if (!empty($incomingStockFilter) || !empty($outcomingStockFilter)) {
                $query->where(function ($query) use ($incomingStockFilter, $outcomingStockFilter) {
                    if (!empty($incomingStockFilter)) {
                        $query->where('incoming_stock', '>=', $incomingStockFilter);
                    }

                    if (!empty($outcomingStockFilter)) {
                        $query->where('outcoming_stock', '>=', $outcomingStockFilter);
                    }
                });
            }

            return DataTables::of($query)
                ->editColumn('image', function ($item) {
                    return $item->product->image ? '<img src="' . Storage::url($item->product->image) . '" style="height: 60px; width: 60px;"/>' : '';
                })
                ->rawColumns(['image'])
                ->make(true);
        }

        return view('admin.stock.history.index');
    }
}
