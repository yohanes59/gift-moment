@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="px-4 pb-14 mx-auto w-full max-w-screen-xl">
        <div class="mt-10">
            <a href="{{ url('/history') }}" class="flex font-semibold text-indigo-600 text-sm">
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                    <path
                        d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="my-4 font-semibold">Detail Pesanan</div>

        <div class="flex flex-col sm:flex-row gap-4">
            {{-- produk --}}
            <div class="w-full">
                <div class="p-5 border border-indigo-100 bg-white shadow-md shadow-indigo-100 rounded-md">
                    <div class="font-bold">Rincian Produk</div>

                    <div class="flex border-b-2 border-indigo-50 py-5">
                        <h3 class="font-semibold text-slate-600 text-xs uppercase w-2/5 px-0 sm:px-6">Nama Produk</h3>
                        <h3 class="font-semibold text-center text-slate-600 text-xs uppercase w-1/5 text-center">
                            Qty
                        </h3>
                        <h3 class="font-semibold text-center text-slate-600 text-xs uppercase w-1/5 text-center">
                            Harga</h3>
                        <h3 class="font-semibold text-center text-slate-600 text-xs uppercase w-1/5 text-center">
                            Subtotal
                        </h3>
                    </div>
                    {{-- list produk --}}
                    <div class="flex flex-col gap-3">
                        @foreach ($data as $product_id => $item_data)
                            <div class="flex items-center py-5 bg-white">
                                <div class="flex w-2/5 gap-3 pl-0 sm:pl-6">
                                    <div class="w-fit">
                                        <div class="w-16 md:w-24 h-16 md:h-24 rounded-md overflow-hidden">
                                            <img class="w-full h-full object-cover"
                                                src="{{ Storage::url($item_data['product_image']) }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-center w-full">
                                        <span
                                            class="font-bold text-sm line-clamp-2">{{ $item_data['product_name'] }}</span>
                                        <span
                                            class="text-sm text-slate-500">{{ $item_data['weight'] }}gr</span>
                                    </div>
                                </div>
                                <div class="flex justify-center w-1/5">
                                    <p class="mx-2 text-center w-12">{{ $item_data['qty'] }} <span class="hidden sm:inline">pcs</span></p>
                                </div>
                                <span class="text-center w-1/5 font-semibold text-sm">Rp
                                    {{ number_format($item_data['product_price'], 0, ',', '.') }}</span>
                                <span class="text-center w-1/5 font-semibold text-sm">Rp
                                    {{ number_format($item_data['sub_total'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- pengiriman --}}
            <div class="w-full max-w-sm">
                <div class="p-5 border border-indigo-100 bg-white shadow-md shadow-indigo-100 rounded-md">
                    <div class="font-bold">Informasi Pengiriman</div>
    
                    @foreach ($courier as $item)
                        <div class="flex flex-col gap-3 mt-4 text-sm">
                            <div class="flex text-slate-600">
                                <div class="w-28 flex justify-between mr-3">
                                    <span>Kurir</span>
                                    <span>:</span>
                                </div>
                                <div class="font-medium">{{ $item->courier }}</div>
                            </div>
                            <div class="flex text-slate-600">
                                <div class="w-28 flex justify-between mr-3">
                                    <span>Biaya Ongkir</span>
                                    <span>:</span>
                                </div>
                                <div class="font-medium">Rp {{ number_format($item->shipping_costs, 0, ',', '.') }}</div>
                            </div>
                            <div class="text-slate-600">
                                Alamat : 
                                <span>
                                    <div class="font-bold">{{ auth()->user()->name }}</div>
                                    <div>{{ $userDetailData->phone_number }}</div>
                                    <div>{{ $userDetailData->address }},
                                        {{ $userDetailData->address_detail }}</div>
                                    <div>{{ $provinceName }}, {{ $cityName }},
                                        {{ $userDetailData->postal_code }}</div>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('backTop')
    <!-- Back to Top -->
    <a id="back-to-top" onclick="toTop()" class="fixed z-[9999] bottom-6 right-6 cursor-pointer hidden items-center justify-center w-14 h-14 bg-indigo-500 text-white text-xl rounded-full p-4">
        <i class="fa-solid fa-chevron-up"></i>
    </a>
@endsection