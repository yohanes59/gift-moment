@extends('layouts.app-admin')

@section('title', 'Detail Transaksi')

@section('admin')
    <div class="mt-3">
        <div class="mb-8">
            <x-link to="{{ url('admin/transaction') }}" size="lg" icon="fa-chevron-left mr-1" text="Kembali"
                padding="py-2 px-4" color="blue" />
        </div>
        <div class="flex flex-col space-y-2 mb-3">
            <div class="w-fit bg-green-100 text-green-800 text-md font-medium px-2.5 py-1 rounded">ID Transaksi :
                {{ substr($detailTransaction[0]['transactions_id'], -8) }}</div>
            <div class="w-fit bg-green-100 text-green-800 text-md font-medium px-2.5 py-1 rounded">Nama Customer :
                {{ $detailTransaction[0]['transaction']['user']['name'] }}
            </div>
            <div class="w-fit bg-green-100 text-green-800 text-md font-medium px-2.5 py-1 rounded">Kurir :
                {{ $detailTransaction[0]['transaction']['courier'] }}
            </div>
            <div class="w-fit bg-green-100 text-green-800 text-md font-medium px-2.5 py-1 rounded">Biaya Kirim :
                Rp. {{ number_format($detailTransaction[0]['transaction']['shipping_costs'], 0, ',', '.') }}
            </div>
        </div>
        
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="py-3 px-6">
                            Kategori
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Gambar
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nama Produk
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Berat <span class="lowercase">(gr)</span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Harga Satuan
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Jumlah
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Harga Subtotal
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($detailTransaction as $item)
                        <tr>
                            <td class="py-3 px-6">{{ $item->product->category->name }}</td>
                            <td class="py-3 px-6"><img src="{{ Storage::url($item->product_image) }}"
                                    style="height: 60px; width: 60px;"></td>
                            <td class="py-3 px-6">
                                <li>{{ $item->product_name }}</li>
                            </td>
                            <td class="py-3 px-6">{{ $item->weight }}</td>
                            <td class="py-3 px-6">Rp {{ number_format($item->product_price, 0, ',', '.') }}</td>
                            <td class="py-3 px-6">{{ $item->qty }}</td>
                            <td class="py-3 px-6">Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
