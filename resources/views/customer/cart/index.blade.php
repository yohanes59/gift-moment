@extends('layouts.app')

@section('title', 'Cart')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-[73px] md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div class="container mx-auto mt-20">
        @if ($cart->count() > 0)
            <div class="flex my-10">
                <div class="w-full sm:w-3/4 bg-white px-2 sm:px-10 py-10">
                    <div class="flex justify-between border-b pb-8 px-2">
                        <h1 class="font-semibold text-2xl">Keranjang Belanja</h1>
                        <h2 class="font-semibold text-2xl">{{ count($cart) }} Items</h2>
                    </div>
                    <div class="flex mt-10 mb-5">
                        <h3 class="font-semibold text-slate-600 text-xs uppercase w-2/5 px-2 sm:px-6">Produk Detail</h3>
                        <h3 class="font-semibold text-center text-slate-600 text-xs uppercase w-2/5 text-center">Quantity
                        </h3>
                        <h3 class="pr-3 sm:pr-0 font-semibold text-center text-slate-600 text-xs uppercase w-1/5 text-center">Harga</h3>
                        <h3 class="hidden sm:inline font-semibold text-center text-slate-600 text-xs uppercase w-1/5 text-center">Subtotal
                        </h3>
                    </div>

                    @php $total = 0 @endphp
                    <form action="{{ url('/cart/checkout') }}" method="POST">
                        @csrf
                        @foreach ($cart as $item)
                            <div
                                class="flex items-center py-5 px-2 bg-white border border-indigo-200 mb-3 shadow-md shadow-indigo-100">
                                <div class="flex w-2/5 gap-3 sm:pl-4">
                                    <!-- product -->
                                    <input type="hidden" value="{{ $item->product->id }}" name="products_id[]">
                                    <div class="w-fit">
                                        <div class="w-16 md:w-24 h-16 md:h-24 rounded-md overflow-hidden">
                                            <img class="w-full h-full object-cover"
                                                src="{{ Storage::url($item->product->image) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1 w-full">
                                        <span class="font-bold text-sm line-clamp-2">{{ $item->product->name }}</span>
                                        <span class="text-red-500 text-xs">{{ $item->product->category->name }}</span>
                                        <a href="/cart/{{ $item->id }}"
                                            class="font-semibold hover:text-red-500 text-slate-500 text-xs">Hapus</a>
                                    </div>
                                </div>
                                <div class="flex justify-center w-2/5">
                                    <button type="button" class="quantity-btn minus">
                                        <svg class="fill-current text-indigo-600 w-3" viewBox="0 0 448 512">
                                            <path
                                                d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                        </svg>
                                    </button>
                                    <input type="hidden" id="minimum_order" value="{{ $item->product->minimum_order }}">
                                    <input type="hidden" id="stock" value="{{ $item->product->stock_amount }}">
                                    <input type="number" name="qty[]" class="mx-2 text-center w-12 sm:w-20 border border-indigo-300 rounded-md quantity"
                                        value="{{ $item->qty }}">
                                    <button type="button" class="quantity-btn plus">
                                        <svg class="fill-current text-indigo-600 w-3" viewBox="0 0 448 512">
                                            <path
                                                d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                        </svg>
                                    </button>
                                </div>
                                <span class="text-center w-1/5 font-semibold text-sm cart-price">Rp
                                    {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                <span class="hidden sm:inline text-center w-1/5 font-semibold text-sm subtotal-cart-price"></span>
                                @php $total += $item->qty * $item->product->price @endphp
                            </div>
                        @endforeach

                        <a href="{{ url('/') }}" class="flex font-semibold text-indigo-600 w-fit text-sm mt-4 sm:mt-10 pb-44 sm:pb-0">
                            <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                                <path
                                    d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                            </svg>
                            Lanjut belanja
                        </a>
                </div>

                <div id="summary" class="w-full sm:w-1/4 px-4 md:px-2 lg:px-6 pt-6 pb-4 md:pb-2 lg:py-10 bg-white border border-indigo-200 rounded-md shadow-lg shadow-indigo-100 fixed sm:right-5 sm:bottom-auto right-0 bottom-0">
                    <h1 class="font-semibold text-xl lg:text-2xl border-b pb-8 md:px-2">Ringkasan Pesanan</h1>

                    <div class="flex font-semibold justify-between items-center py-6 md:px-2 text-sm">
                        <span class="uppercase">Total</span>
                        <span class="font-bold text-xl total-cart-price">0</span>
                    </div>
                    <button onclick="window.location.href='{{ url('/checkout') }}';"
                        class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase rounded-md w-full">Checkout</button>
                </div>
                </form>

            </div>
        @else
            <div class="flex flex-col pt-24 justify-center items-center gap-4">
                <div class="flex items-center w-64 h-64 rounded-lg rounded-tr-[60px] rounded-bl-[60px] overflow-hidden">
                    <img class="object-cover" src="{{ asset('assets/img/cart/empty-cart.svg') }}" alt="">
                </div>
                <div>
                    <div class="text-xl text-center font-bold">Yah, keranjangmu masih kosong nih</div>
                    <div class="text-base text-center text-slate-500">Banyak produk menarik menantimu</div>
                </div>
                <a href="{{ url('/') }}"
                    class="px-8 py-3 text-center text-white font-semibold bg-indigo-500 rounded-md hover:opacity-80 duration-300">Ayo
                    Belanja Sekarang</a>
            </div>
        @endif
    </div>
@endsection

@push('addon-script')
    <script>
        // Menampilkan Total Harga
        const quantities = document.getElementsByClassName('quantity');
        const prices = document.getElementsByClassName('cart-price');
        const subtotalCartPrices = document.querySelectorAll('.subtotal-cart-price');
        const totalCartPrices = document.querySelectorAll('.total-cart-price');
        const quantityBtns = document.querySelectorAll('.quantity-btn');

        for (let i = 0; i < quantities.length; i++) {
            updateSubtotal(i);
            quantities[i].addEventListener('change', function() {
                var quantityInput = this;
                var minimumOrder = this.parentNode.querySelector('#minimum_order');
                var stock = this.parentNode.querySelector('#stock');
                var minimumOrderValue = parseInt(minimumOrder.value);
                var stockValue = parseInt(stock.value);

                // check if the current value is less than the minimum order value or greater than the stock value
                if (quantityInput.value < minimumOrderValue) {
                    quantityInput.value = minimumOrderValue;
                } else if (quantityInput.value > stockValue) {
                    quantityInput.value = stockValue;
                }

                // get the index of the corresponding element in the quantities array
                var index = Array.prototype.indexOf.call(quantities, quantityInput);
                // call updateSubtotal with the index
                updateSubtotal(index);
            });
        }

        // listener untuk button plus dan minus
        document.querySelectorAll('.quantity-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var quantityInput = this.parentNode.querySelector('.quantity');
                var minimumOrder = this.parentNode.querySelector('#minimum_order');
                var stock = this.parentNode.querySelector('#stock');
                var minimumOrderValue = parseInt(minimumOrder.value);
                var stockValue = parseInt(stock.value);

                if (this.classList.contains('plus')) {
                    increaseQty(quantityInput, stockValue);
                } else if (this.classList.contains('minus')) {
                    decreaseQty(quantityInput, minimumOrderValue);
                }
            });
        });

        // fungsi untuk menambah nilai input
        function increaseQty(input, maxVal) {
            var value = parseInt(input.value);
            if (isNaN(value)) {
                input.value = 0;
            } else if (value < maxVal) { // tambahkan kondisi ini untuk memeriksa melebihi stok atau tidak
                input.value = value + 1;
                // get the index of the corresponding element in the quantities array
                var index = Array.prototype.indexOf.call(quantities, input);
                // call updateSubtotal with the index
                updateSubtotal(index);
            }
        }

        // fungsi untuk mengurangi nilai input
        function decreaseQty(input, minVal) {
            var value = parseInt(input.value);

            // check if the current value is greater than or equal to the minimum order value before decrementing
            if (value > minVal) {
                input.value = isNaN(value) || value <= 1 ? 1 : value - 1;
                // get the index of the corresponding element in the quantities array
                var index = Array.prototype.indexOf.call(quantities, input);
                // call updateSubtotal with the index
                updateSubtotal(index);
            }
        }

        function updateSubtotal(i) {
            const quantity = parseInt(quantities[i].value);
            const price = parseInt(prices[i].textContent.replace(/\D/g, ''));
            const subtotalPrice = quantity * price;
            subtotalCartPrices[i].textContent = formatNumber(subtotalPrice);

            updateTotal();
        }

        function updateTotal() {
            const total = Array.from(subtotalCartPrices).reduce((acc, curr) => {
                let value = curr.textContent;
                if (typeof value === 'string') {
                    value = parseInt(value.replace(/\D/g, ''));
                }
                return acc + value;
            }, 0);

            totalCartPrices.forEach(el => {
                el.textContent = formatNumber(total);
            });
        }

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
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
