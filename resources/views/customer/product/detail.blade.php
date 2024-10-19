@extends('layouts.app')

@section('title', 'Detail Produk')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-[73px] md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div class="px-4 lg:px-10 mx-auto w-full max-w-screen-xl">
        <!-- Breadcrumb -->
        <div class="pt-4 sm:pt-10">
            <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-white shadow-md"
                aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                            <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Produk</span>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 line-clamp-1">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <form action="{{ url('/product/add-to-cart/' . $product->id) }}" method="POST">
            @csrf
            <div class="w-full mt-3 lg:mt-6 flex flex-col lg:flex-row gap-4 lg:gap-10">
                <div class="w-full lg:w-1/3 h-96">
                    <img class="rounded-xl w-full h-full object-cover" src="{{ asset(Storage::url($product->image)) }}"
                        alt="">
                </div>
                <div class="w-full lg:w-2/5 flex flex-col pt-0 pb-8 md:pb-8 md:pt-8 pr-0 md:pr-6 divide-y">
                    <div>
                        <div class="text-xl font-bold text-gray-900">{{ $product->name }}</div>
                        <div id="product-price" class="text-3xl font-bold text-gray-900 mt-1 mb-5">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="pt-5 px-4">
                        <div class="font-bold text-lg text-indigo-400">Kategori Produk</div>
                        <div class="mt-3 mb-5 font-semibold">{{ $product->category->name }}</div>
                    </div>
                    <div class="pt-5 px-4 pb-64 md:pb-72 lg:pb-0">
                        <div class="font-bold text-lg text-indigo-400">Deskripsi Produk</div>
                        <div id="descText" class="mt-3 line-clamp-5">{!! $product->description !!}</div>
                        <div id="btnShowLess" onclick="showLess()" class="font-semibold cursor-pointer mt-2 text-indigo-900 bg-indigo-100 w-fit py-2 px-4 text-sm rounded-full hover:opacity-80 duration-300">Selengkapnya</div>
                    </div>
                </div>
                <div class="w-full fixed lg:relative bottom-0 left-0 lg:left-auto lg:bottom-auto bg-white px-4 py-2 border-t border-indigo-200 lg:w-1/4 lg:px-0 lg:py-8 md:py-6">
                    <div class="text-md font-bold mb-3">Pilih jumlah</div>
                    <div class="sp-quantity flex justify-between h-14 divide-x p-1 border border-gray-300 rounded-md">
                        <div class="w-full">
                            <a href="#"
                                class="w-full h-full cursor-pointer flex justify-center items-center text-xl font-bold rounded-md hover:bg-indigo-100 hover:text-indigo-600 duration-300 minus-button">-</a>
                        </div>

                        <div class="h-full text-2xl flex justify-center items-center">
                            <input type="number" class="border-none text-center quantity-input"
                                value="{{ $product->stock_amount < $product->minimum_order ? $product->stock_amount : $product->minimum_order }}"
                                name="product_qty">
                        </div>

                        <div class="w-full">
                            <a href="#"
                                class="w-full h-full cursor-pointer flex justify-center items-center text-xl font-bold rounded-md hover:bg-indigo-100 hover:text-indigo-600 duration-300 add-button">+</a>
                        </div>
                        <div class="hidden product-price">{{ $product->price }}</div>
                    </div>
                    <div class="mt-3 text-md">Stok tersedia : <span id="stock-amount">{{ $product->stock_amount }}</span>
                    </div>

                    <div class="mt-4 flex flex-row lg:flex-col justify-between items-center lg:items-start">
                        <div class="text-sm">Subtotal</div>
                        <div id="subtotal" class="text-xl font-bold"></div>
                    </div>
                    <div class="mt-5">
                        <button type="submit"
                            class="w-full text-center text-white font-semibold bg-indigo-500 py-3 px-4 rounded-md hover:opacity-80 duration-300">
                            <i class="fa-solid fa-cart-shopping"></i> Masukkan ke keranjang
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // fungsi spinner, calculate subtotal, dan validasi stok
        // Ambil elemen tombol + dan - serta elemen input
        const addButton = document.querySelector('.add-button');
        const minusButton = document.querySelector('.minus-button');
        const quantityInput = document.querySelector('.quantity-input');
        const subtotal = document.querySelector('#subtotal');
        const productPrice = document.querySelector('#product-price');
        const stockAmount = document.querySelector('#stock-amount');

        const stock = parseInt(stockAmount.textContent);

        // Menghitung subtotal
        const calculateSubtotal = () => {
            const priceString = productPrice.textContent.replace(/[\D]/g, '');
            const price = parseInt(priceString);
            const quantity = parseInt(quantityInput.value);
            const subtotalValue = price * quantity;
            const formattedSubtotal = new Intl.NumberFormat('id-ID', {
                style: 'decimal'
            }).format(subtotalValue);
            subtotal.textContent = `Rp ${formattedSubtotal}`;
        }

        // Tambahkan event listener pada tombol +
        addButton.addEventListener('click', function(e) {
            e.preventDefault();
            const currentValue = parseInt(quantityInput.value);
            if (currentValue < stock) {
                quantityInput.value = currentValue + 1;
                calculateSubtotal();
            }
        });

        // Tambahkan event listener pada tombol -
        minusButton.addEventListener('click', function(e) {
            e.preventDefault();
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > {{ $product->minimum_order }}) {
                quantityInput.value = currentValue - 1;
                calculateSubtotal();
            }
        });

        // Hitung subtotal saat halaman dimuat
        calculateSubtotal();

        quantityInput.addEventListener('change', () => {
            const quantity = parseInt(quantityInput.value);
            if (quantity > stock) {
                quantityInput.value = stock;
                calculateSubtotal();
            } else if (quantity < {{ $product->minimum_order }}) {
                quantityInput.value = {{ $product->minimum_order }};
                calculateSubtotal();
            } else {
                calculateSubtotal();
            }
        });
    </script>

    <script>
        const content = document.querySelector('#descText');
        const btnShowLess = document.querySelector('#btnShowLess');

        function showLess() {
            if (content.classList.contains('line-clamp-5')) {
                btnShowLess.innerHTML = "Lebih sedikit";
                content.classList.remove('line-clamp-5');
            } else {
                btnShowLess.innerHTML = "Selengkapnya";
                content.classList.add('line-clamp-5');
            }
        }
    </script>
@endpush

@push('addon-style')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endpush
