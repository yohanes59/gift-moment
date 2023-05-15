@extends('layouts.app-admin')

@section('title', 'Stok')

@section('admin')
    <div class="ml-5 mt-3">
        <div class="flex gap-3 items-center">
            <x-link to="{{ url('admin/stock/masuk') }}" size="lg" icon="fa-chevron-left mr-1" text="Kembali" padding="py-2 px-4"
                color="blue" />
            <div class="text-lg font-medium">Stok Masuk</div>
        </div>

        <div class="max-w-2xl mt-3 p-4 bg-white shadow-md rounded-md">
            <form class="space-y-4" action=""
                method="POST" enctype="multipart/form-data">
                
                @csrf
                <div>
                    <div class="space-y-2">
                        <div>
                            <label for="product_id"
                                class="block mb-2 text-sm font-medium text-slate-900">Produk</label>
                            <select name="product_id"
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                id="product_id" required>
                                <option disabled selected>Pilih produk</option>
                                
                            </select>
                            @error('product_id')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="stock_in" class="block mb-2 text-sm font-medium text-slate-900">Jumlah Stok</label>
                            <input type="number" name="stock_in" id="stock_in"
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                >
                            @error('stock_in')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <button type="submit"
                    class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                    <span><i class="fa-solid fa-check mr-1"></i></span>
                    Submit
                </button>
            </form>
        </div>
    </div>
@endsection