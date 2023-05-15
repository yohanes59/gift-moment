@extends('layouts.app-admin')

@section('title', 'Stok Keluar')

@section('admin')
    <div class="mt-3">
        <div class="text-xl font-medium mb-8">List Stok Keluar</div>

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
                            Tanggal Keluar
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">

                </tbody>
            </table>
        </div>
    </div>
@endsection