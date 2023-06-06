@extends('layouts.app-admin')

@section('title', 'Detail Transaksi')

@section('admin')
    <div class="mt-3">
        <div class="mb-8">
            <x-link to="{{ url('admin/transaction') }}" size="lg" icon="fa-chevron-left mr-1" text="Kembali"
                padding="py-2 px-4" color="blue" />
        </div>

        <div class="flex gap-3">
            <div class="flex flex-col bg-white border rounded-md p-3 space-y-2 mb-3">
                <div class="w-fit text-green-800 text-md px-2.5 py-1 rounded">ID Transaksi :
                    <span class="font-medium">{{ substr($detailTransaction[0]['transactions_id'], -8) }}</span>
                </div>
                <div class="w-fit text-green-800 text-md px-2.5 py-1 rounded">Nama Customer :
                    <span class="font-medium">{{ $detailTransaction[0]['transaction']['user']['name'] }}</span>
                </div>
            </div>
            <div class="flex flex-col bg-white border rounded-md p-3 space-y-2 mb-3">
                <div class="w-fit text-green-800 text-md px-2.5 py-1 rounded">Kurir :
                    <span class="font-medium">{{ $detailTransaction[0]['transaction']['courier'] }}</span>
                </div>
                <div class="w-fit text-green-800 text-md px-2.5 py-1 rounded">Biaya Kirim :
                    <span class="font-medium">Rp. {{ number_format($detailTransaction[0]['transaction']['shipping_costs'], 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="flex flex-col bg-white border rounded-md p-3 space-y-2 mb-3 cursor-pointer hover:brightness-50 duration-300" data-modal-target="buktiPembayaran" data-modal-toggle="buktiPembayaran" data-tooltip-target="bukti-bayar">
                <div class="text-sm">Lihat bukti pembayaran</div>
                <div class="w-fit h-fit mt-2">
                    <img class="h-20" src="{{ Storage::url($paymentData->image) }}" alt="">
                </div>
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

    <!-- Main modal -->
    <div id="buktiPembayaran" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Bukti Pembayaran
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="buktiPembayaran">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <img src="{{ Storage::url($paymentData->image) }}" alt="">
                </div>
            </div>
        </div>
    </div>

    {{-- tooltip --}}
    <div id="bukti-bayar" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Lihat Bukti Pembayaran
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
@endsection
