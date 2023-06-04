@extends('layouts.app-admin')

@section('title', 'Dashboard')

@section('admin')
    <div class="lg:ml-3 mt-3">
        <div class="flex flex-wrap gap-3">
            <div
                class="w-full lg:max-w-xs p-6 flex items-center justify-between bg-blue-100 border-b-8 border-blue-400 rounded-lg shadow-md">
                <div class="w-20 h-20 rounded-full bg-blue-400 text-white flex items-center justify-center">
                    <i class="fa-solid fa-file-invoice text-4xl"></i>
                </div>
                <div class="space-y-2 w-full max-w-[180px]">
                    <h5 class="text-center text-sm uppercase font-bold text-slate-600">Monthly Transactions Total</h5>
                    <p class="text-center font-bold text-3xl text-slate-950">{{ $transactions }}</p>
                </div>
            </div>
            <div
                class="w-full lg:max-w-xs p-6 flex items-center justify-between bg-orange-100 border-b-8 border-orange-400 rounded-lg shadow-md">
                <div class="w-20 h-20 rounded-full bg-orange-400 text-white flex items-center justify-center">
                    <i class="fa-solid fa-tags text-4xl"></i>
                </div>
                <div class="space-y-2 w-full max-w-[180px]">
                    <h5 class="text-center text-sm uppercase font-bold text-slate-600">Monthly Sales Total</h5>
                    <p class="text-center font-bold text-3xl text-slate-950">Rp. {{ number_format($sales, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            <div
                class="w-full lg:max-w-xs p-6 flex items-center justify-between bg-emerald-100 border-b-8 border-emerald-400 rounded-lg shadow-md">
                <div class="w-20 h-20 rounded-full bg-emerald-500 text-white flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-trend-up text-4xl"></i>
                </div>
                <div class="space-y-2 w-full max-w-[180px]">
                    <h5 class="text-center text-sm uppercase font-bold text-slate-600">Monthly Profit Total</h5>
                    <p class="text-center font-bold text-3xl text-slate-950">Rp. {{ number_format($profits, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <div class="text-xl font-medium mb-8">Stock Warning</div>
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-indigo-500">
                        <tr class="divide-x divide-y">
                            <th scope="col" class="py-3 px-6">
                                No
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Kategori
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Nama Produk
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Sisa Stok
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($stockAlerts as $item)
                            <tr class="divide-x divide-y">
                                <td scope="col" class="py-3 px-6">
                                    {{ $loop->iteration }}
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    {{ $item->category->name }}
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    {{ $item->name }}
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    {{ $item->stock_amount }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
