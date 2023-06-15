<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\InStockRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class InStockController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Stock::with('product')->where('incoming_stock', '>', 0);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <td class="w-32 py-4 px-6">
                        <div class="flex items-center space-x-2">
                            <button class="py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600" onclick="deleteData(\'' . $item->id . '\')" data-bs-toggle="tooltip-delete" data-bs-title="Hapus Stok">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                ';
                })
                ->editColumn('image', function ($item) {
                    return $item->product->image ? '<img src="' . Storage::url($item->product->image) . '" style="height: 60px; width: 60px;"/>' : '';
                })
                ->rawColumns(['action', 'image'])
                ->make();
        }
        return view('admin.stock.masuk.index');
    }

    public function create()
    {
        $product = Product::get();
        return view('admin.stock.masuk.form', compact('product'));
    }

    public function store(InStockRequest $request)
    {
        $data = $request->all();
        $data['incoming_stock'] = $request->amount;

        // update product stock_amount column
        $product = Product::find($request->products_id);
        $product->stock_amount += $request->amount;
        $product->save();

        unset($data['amount']);
        Stock::create($data);

        return redirect('admin/stock/masuk')->with('toast_success', 'Data Berhasil Disimpan!');
    }

    public function destroy($id)
    {
        $item = Stock::findOrFail($id);
        $item->delete();
        return back()->with('info', 'Data Berhasil Dihapus!');
    }
}
