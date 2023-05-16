<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Faq::all();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <td class="w-32 py-4 px-6">
                        <div class="flex items-center space-x-2">
                            <a href="/admin/faq/' . $item->id . '/edit"
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
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $data = $request->all();
        Faq::create($data);
        return redirect('admin/faq')->with('toast_success', 'Data Berhasil Disimpan!');
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
        $item = Faq::findOrFail($id);
        return view('admin.faq.form', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, $id)
    {
        $item = Faq::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return redirect('/admin/faq')->with('toast_success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Faq::findOrFail($id);
        $item->delete();
        return back()->with('info', 'Data Berhasil Dihapus!');
    }
}
