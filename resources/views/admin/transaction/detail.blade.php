@extends('layouts.app-admin')

@section('title', 'Detail Transaksi')

@section('admin')
    <div class="mt-3">
        <div class="mb-8">
            <x-link to="{{ url('admin/transaction') }}" size="lg" icon="fa-chevron-left mr-1" text="Kembali" padding="py-2 px-4"
                color="blue" />
        </div>
        <div class="flex flex-col space-y-2 mb-3">
            <div class="w-fit bg-green-100 text-green-800 text-md font-medium px-2.5 py-1 rounded">ID Transaksi : #####</div>
            <div class="w-fit bg-green-100 text-green-800 text-md font-medium px-2.5 py-1 rounded">Nama Customer : #####</div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="py-3 px-6">
                            Nama Produk
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Berat <span class="lowercase">(gr)</span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Kategori
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Harga Satuan
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Jumlah
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Harga Total
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    <tr>
                        <td class="py-3 px-6">
                            <li>Cutting Acrylic 20x30cm</li>
                        </td>
                        <td class="py-3 px-6">2000</td>
                        <td class="py-3 px-6">Hantaran</td>
                        <td class="py-3 px-6">Rp 300.000</td>
                        <td class="py-3 px-6">1</td>
                        <td class="py-3 px-6">Rp 300.000</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6">
                            <li>Gelas</li>
                        </td>
                        <td class="py-3 px-6">3000</td>
                        <td class="py-3 px-6">Souvenir</td>
                        <td class="py-3 px-6">Rp 4.000</td>
                        <td class="py-3 px-6">30</td>
                        <td class="py-3 px-6">Rp 120.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection