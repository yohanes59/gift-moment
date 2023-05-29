@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="px-4 lg:px-10 mx-auto w-full max-w-screen-xl">
        
        @if ($cart->count() > 0)
            <!-- Breadcrumb -->
            <div class="pt-10">
                <nav class="flex px-5 py-3 text-slate-700 border border-slate-200 rounded-lg bg-white shadow-md" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-blue-600">
                            <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Beranda
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg aria-hidden="true" class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2">Keranjang</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            {{-- List produk --}}
            <form action="">
                <div class="w-full mt-6 pb-12 flex gap-10">
                    <div class="w-2/3 flex flex-col gap-4">
                        @foreach ($cart as $item)
                            <div class="bg-white border border-slate-200 shadow-sm">
                                <div class="flex items-center gap-4 p-4">
                                    <input id="bordered-checkbox-1" type="checkbox" value="" name="bordered-checkbox" class="w-4 h-4 text-blue-600 bg-slate-100 border-slate-300 rounded">

                                    <div class="flex w-full justify-between gap-4">
                                        <div class="flex gap-3">
                                            <div class="w-16 h-16 rounded-lg overflow-hidden">
                                                <img class="object-cover" src="{{ asset(Storage::url($item->product_image)) }}" alt="">
                                            </div>
                                            <div class="flex flex-col">
                                                <div class="text-base line-clamp-2">{{ $item->product_name }}</div>
                                                <div class="text-base font-bold">Rp {{ number_format($item->product_price, 0, ',', '.') }}</div>
                                            </div>
                                        </div>

                                        {{-- action --}}
                                        <div class="flex">
                                            {{-- edit qty --}}
                                            <div class="flex items-center">
                                                <div class="w-[200px]">
                                                    <div class="sp-quantity flex justify-between h-14 divide-x p-1 border border-gray-300 rounded-md">
                                                        <div class="w-full">
                                                            <a href="#"
                                                                class="w-full h-full cursor-pointer flex justify-center items-center text-base font-bold rounded-md hover:bg-indigo-100 hover:text-indigo-600 duration-300 minus-button">-</a>
                                                        </div>
                                
                                                        <div class="h-full text-2xl flex justify-center items-center">
                                                            <input type="text" class="border-none max-w-[100px] text-center quantity-input" value="{{ $item->qty }}"
                                                                min="" name="product_qty">
                                                        </div>
                                
                                                        <div class="w-full">
                                                            <a href="#"
                                                                class="w-full h-full cursor-pointer flex justify-center items-center text-base font-bold rounded-md hover:bg-indigo-100 hover:text-indigo-600 duration-300 add-button">+</a>
                                                        </div>
                                                        <div class="hidden product-price">{{ $item->product_price }}</div>
                                                    </div>
                                                </div>
                                            </div>
        
                                            {{-- action delete --}}
                                            <div class="flex items-center px-4">
                                                <form action="" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Yakin Ingin Menghapus produk Ini?')" class="text-red-500 hover:text-red-600">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="w-1/3">
                        <div class="py-8 px-4 bg-white border border-slate-200 shadow-lg rounded-lg">
                            <div class="text-md font-bold mb-3">Ringkasan</div>
                            <div class="mt-4">
                                <div class="text-sm">Total</div>
                                <div id="subtotal" class="text-md font-bold flex gap-1">-</div>
                            </div>
                            <div class="mt-5">
                                <button type="submit"
                                    class="w-full text-center text-white font-semibold bg-indigo-500 py-3 px-4 rounded-md hover:opacity-80 duration-300">
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="flex flex-col pt-24 justify-center items-center gap-4">
                <div class="flex items-center w-64 h-64 rounded-lg rounded-tr-[60px] rounded-bl-[60px] overflow-hidden">
                    <img class="object-cover" src="{{ asset('assets/img/empty-cart.png') }}" alt="">
                </div>
                <div>
                    <div class="text-xl text-center font-bold">Yah, keranjangmu masih kosong nih</div>
                    <div class="text-base text-center text-slate-500">Banyak produk menarik menantimu</div>
                </div>
                <a href="{{ url('/') }}" class="px-8 py-3 text-center text-white font-semibold bg-indigo-500 rounded-md hover:opacity-80 duration-300">Ayo Mulai Belanja</a>
            </div>
        @endif
    </div>
@endsection