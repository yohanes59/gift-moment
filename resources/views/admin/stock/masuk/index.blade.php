@extends('layouts.app-admin')

@section('title', 'Stok Masuk')

@section('admin')
    <div class="mt-3">
        <div class="text-xl font-medium mb-8">List Stok Masuk</div>

        {{-- Tambah data --}}
        <div class="my-6">
            <x-link to="{{ url('admin/stock/masuk/form') }}" size="md" icon="fa-plus mr-1" text="Tambah Stok Produk" padding="py-3 px-5" />
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="py-3 px-6">
                            Produk
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Stok
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Tanggal Masuk
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">

                </tbody>
            </table>
        </div>
    </div>
@endsection