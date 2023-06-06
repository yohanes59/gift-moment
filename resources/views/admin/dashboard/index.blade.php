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

        <div class="mt-5 mb-3">
            <div class="text-xl font-medium mb-3">Produk Terlaris Bulan Ini</div>
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-indigo-500">
                        <tr class="divide-x divide-y">
                            <th scope="col" class="py-3 px-6">
                                No
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Kategori Produk
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Nama Produk
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Jumlah Terjual
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($bestSellingProducts as $item)
                            <tr class="divide-x divide-y">
                                <td scope="col" class="py-3 px-6">
                                    {{ $loop->iteration }}
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    {{ $item->product->category->name }}
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    {{ $item->product->name }}
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    {{ $item->total_outcoming_stock }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-5 mb-3">
            <div class="text-xl font-medium mb-3">Transaction Shortcut</div>
            {{-- Table --}}
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                    <thead class="text-xs text-white uppercase bg-indigo-500">
                        <tr class="divide-x divide-y">
                            <th scope="col" class="w-16 py-3 px-6">
                                ID
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Tanggal Transaksi
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Nama
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Total
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Status Pembayaran
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Status Pesanan
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($transactionShortcut as $item)
                            @php
                                $payment = App\Models\Payment::where('transactions_id', $item->id)->first();
                            @endphp
                            <tr>
                                <td scope="col" class="py-3 px-6">
                                    {{ substr($item->id, -8) }}
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    {{ date('j F Y - H.i', strtotime($item->created_at)) }}
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    {{ $item->user->name }}
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    {{ number_format($item->total, 0, ',', '.') }}
                                </td>
                                <td scope="col" class="py-3 px-6 text-center">
                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                        {{ $item->payment_status }}
                                    </span>
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    @if ($item->order_status == null && isset($payment))
                                        Menunggu Konfirmasi Pembayaran
                                    @elseif ($item->order_status == null && !isset($payment))
                                        Menunggu Pembayaran Customer
                                    @else
                                        {{ $item->order_status }}
                                    @endif
                                </td>
                                <td scope="col" class="py-3 px-6">
                                    @if ($item->payment_status == 'CANCELLED')
                                        <div class="flex items-center space-x-2">
                                            <a href="/admin/transaction/{{ $item->id }}/show"
                                                class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                        </div>
                                    @elseif ($item->payment_status == 'UNPAID' && !isset($payment))
                                        <div class="flex items-center space-x-2">
                                            <a href="/admin/transaction/{{ $item->id }}/show"
                                                class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                            <a href="/admin/transaction/{{ $item->id }}/cancel-order"
                                                class="py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Batalkan Pesanan"
                                                onclick="return confirm(&quot;Yakin Ingin Membatalkan Pesanan Ini?&quot;)">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        </div>
                                    @elseif ($item->payment_status == 'UNPAID' && isset($payment))
                                        <div class="flex items-center space-x-2">
                                            <a href="/admin/transaction/{{ $item->id }}/show"
                                                class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                            <a href="/admin/transaction/{{ $item->id }}/show-payment"
                                                class="py-2 px-3 rounded-md text-white bg-yellow-500 hover:bg-yellow-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Cek Bukti Pembayaran">
                                                <i class="fa-solid fa-receipt"></i>
                                            </a>
                                            <a href="/admin/transaction/{{ $item->id }}/update-status"
                                                class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Ubah Status Pesanan"
                                                onclick="return confirm(&quot;Yakin Ingin Mengubah Status Pesanan Ini?&quot;)">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                            <a href="/admin/transaction/{{ $item->id }}/cancel-order"
                                                class="py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Batalkan Pesanan"
                                                onclick="return confirm(&quot;Yakin Ingin Membatalkan Pesanan Ini?&quot;)">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        </div>
                                    @elseif ($item->order_status == 'NEW_ORDER')
                                        <div class="flex items-center space-x-2">
                                            <a href="/admin/transaction/{{ $item->id }}/show"
                                                class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                            <a href="/admin/transaction/{{ $item->id }}/update-status"
                                                class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Ubah Status Pesanan"
                                                onclick="return confirm(&quot;Yakin Ingin Mengubah Status Pesanan Ini?&quot;)">
                                                <i class="fa-solid fa-box"></i>
                                            </a>
                                        </div>
                                    @elseif ($item->order_status == 'PACKED')
                                        <div class="flex items-center space-x-2">
                                            <a href="/admin/transaction/{{ $item->id }}/show"
                                                class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                            <a href="/admin/transaction/{{ $item->id }}/update-status"
                                                class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Ubah Status Pesanan"
                                                onclick="return confirm(&quot;Yakin Ingin Mengubah Status Pesanan Ini?&quot;)">
                                                <i class="fa-solid fa-truck-fast"></i>
                                            </a>
                                        </div>
                                    @else
                                        <div class="flex items-center space-x-2">
                                            <a href="/admin/transaction/{{ $item->id }}/show"
                                                class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600"
                                                data-bs-toggle="tooltip-detail" data-bs-title="Lihat detail transaksi">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $transactionShortcut->links() }}

        <div class="mt-5 mb-3">
            <div class="text-xl font-medium mb-3">Stock Warning</div>
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
        {{ $stockAlerts->links() }}
    </div>
@endsection
