@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="px-4 lg:px-10 pb-14 mx-auto w-full max-w-screen-xl">

        <div>
            <a href="{{ url('/cart') }}" class="flex font-semibold text-indigo-600 text-sm mt-10">
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                    <path
                        d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="font-bold text-2xl my-4">Checkout</div>

        <div class="flex">
            <div class="w-3/4 pr-5">
                <div class="flex flex-col gap-4">
                    {{-- Alamat --}}
                    <div class="flex flex-col gap-3 border-b-2 border-indigo-200">
                        <div class="font-bold">Alamat Pengiriman</div>

                        <div class="w-full flex flex-col px-2">
                            <div class="font-bold">Nama Pembeli</div>
                            <div class="">08123456789</div>
                            <div class="text-slate-500">Detail Alamat, Lorem ipsum dolor sit amet consectetur, adipisicing
                                elit. Aspernatur natus necessitatibus magni eveniet obcaecati voluptatum saepe culpa sed
                                sunt quod!</div>
                            <div class="text-slate-500">Provinsi, Kabupaten, Kode Pos</div>

                            <div class="py-8">
                                <a href="/checkout/address/{{ Auth::user()->id }}"
                                    class="py-2 px-6 bg-white border-2 border-indigo-200 hover:bg-indigo-500 hover:border-indigo-500 hover:text-white duration-300 rounded-md font-medium text-center">
                                    <i class="fa-solid fa-location-pin mr-1"></i>Edit Alamat
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Pesanan --}}
                    <div class="flex flex-col gap-3 pb-6 border-b-2 border-indigo-200">
                        <div class="font-bold">Pesanan</div>

                        {{-- list produk --}}
                        <div class="flex flex-col gap-3">
                            @foreach ($data['checkout_data'] as $product_id => $item_data)
                                {{-- {{ var_dump($product_data) }} --}}
                                <div class="w-full flex gap-3 px-2">
                                    <div class="w-fit">
                                        <div class="w-32 h-32 rounded-md overflow-hidden">
                                            <img class="object-cover" src="{{ Storage::url($item_data['product_image']) }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="flex flex-col py-2">
                                        <div>{{ $item_data['product_name'] }}</div>
                                        <div class="text-slate-500">{{ $item_data['qty'] }} pcs</div>
                                        <div class="font-semibold">Rp
                                            {{ number_format($item_data['product_price'], 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- Kurir --}}
                    <div class="flex flex-col gap-3 pb-6 border-b-2 border-indigo-200">
                        <div class="font-bold">Kurir</div>

                        <div class="w-full flex flex-col px-2">
                            <div>Pilihan : <span class="font-bold">Nama Kurir (muncul jika sudah dipilih)</span></div>

                            <div class="pt-6 pb-2">
                                <a href="{{ url('/checkout/courier') }}"
                                    class="py-2 px-6 bg-white border-2 border-indigo-200 hover:bg-indigo-500 hover:border-indigo-500 hover:text-white duration-300 rounded-md font-medium text-center">
                                    <i class="fa-solid fa-truck-fast mr-1"></i>Pilih Kurir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/4">
                <div class="px-4 lg:px-6 py-4 border border-indigo-100 rounded-md shadow-lg shadow-indigo-100">
                    @php
                        $subtotal = 0;
                        foreach ($data['checkout_data'] as $product_id => $item_data) {
                            $subtotal += $item_data['sub_total'];
                        }
                    @endphp
                    <div class="flex justify-between font-semibold text-lg">
                        <span>Ringkasan</span>
                        <span>{{ count($data['checkout_data']) }} Items</span>
                    </div>
                    <div class="flex flex-col gap-2 mt-4">
                        <div class="flex justify-between">
                            <span>Subtotal Produk</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mb-4">
                            <span>Total Ongkos Kirim</span>
                            <span>Rp 20.000</span>
                        </div>

                        <div class="py-4 border-t-2 border-indigo-300 flex flex-col gap-4">
                            <div class="flex justify-between font-bold">
                                <span>Total Belanja</span>
                                <span>Rp 220.000</span>
                            </div>
                            <div>
                                <button onclick="window.location.href='{{ url('/checkout') }}';"
                                    class="bg-indigo-500 font-bold hover:bg-indigo-600 py-3 text-sm text-white rounded-md w-full">
                                    Lanjut Pembayaran??
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
