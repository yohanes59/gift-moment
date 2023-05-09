<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Product::with('category');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <td class="w-32 py-4 px-6">
                        <div class="flex items-center space-x-2">
                            <a href="/admin/product/' . $item->id . '/edit"
                                class="py-2 px-3 rounded-md text-white bg-yellow-500 hover:bg-yellow-600">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <button class="py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600" onclick="deleteData(\'' . $item->id . '\')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                ';
                })
                ->editColumn('image', function ($item) {
                    return $item->image ? '<img src="' . Storage::url($item->image) . '" style="max-height: 40px;"/>' : '';
                })
                ->rawColumns(['action', 'image'])
                ->make();
        }
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::get();
        return view('admin.product.form', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $data['image'] = $request->file('image')->storeAs('assets/product', $newName, 'public');
        }

        Product::create($data);

        return redirect('admin/product')->with('toast_success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Product::findOrFail($id);
        $category = Category::get();
        return view('admin.product.form', compact(['item', 'category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $item = Product::findOrFail($id);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;

            $data['image'] = $request->file('image')->storeAs('assets/product', $newName, 'public');
            Storage::delete('public/' . $item->image);
        }

        $item->update($data);

        return redirect('/admin/product')->with('toast_success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();
        return back()->with('info', 'Data Berhasil Dihapus!');
    }
}
