<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class RemainingStockController extends Controller
{
    public function index()
    {
        // kurang dikurangi outcoming stock
        if (request()->ajax()) {
            $query = Product::all();

            return DataTables::of($query)
                ->editColumn('image', function ($item) {
                    return $item->image ? '<img src="' . Storage::url($item->image) . '" style="max-height: 40px;"/>' : '';
                })
                ->rawColumns(['image'])
                ->make();
        }
        return view('admin.stock.sisa.index');
    }
}
