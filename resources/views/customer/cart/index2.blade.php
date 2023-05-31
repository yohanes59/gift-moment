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
                <div class="w-3/4 bg-white px-10 py-10">
                    <div class="flex justify-between border-b pb-8">
                        <h1 class="font-semibold text-2xl">Keranjang Belanja</h1>
                        <h2 class="font-semibold text-2xl">{{ count($cart) }} Items</h2>
                    </div>
                    <div class="flex mt-10 mb-5">
                        <h3 class="font-semibold text-slate-600 text-xs uppercase w-2/5 px-6">Produk Detail</h3>
                        <h3 class="font-semibold text-center text-slate-600 text-xs uppercase w-1/5 text-center">Quantity
                        </h3>
                        <h3 class="font-semibold text-center text-slate-600 text-xs uppercase w-1/5 text-center">Harga</h3>
                        <h3 class="font-semibold text-center text-slate-600 text-xs uppercase w-1/5 text-center">Subtotal
                        </h3>
                    </div>

                    @php $total = 0 @endphp
                    <form action="{{ url('/cart/checkout') }}" method="POST">
                        @csrf
                        @foreach ($cart as $item)
                            <div
                                class="flex items-center hover:bg-slate-100 py-5 bg-white border border-indigo-200 mb-3 shadow-md shadow-indigo-100">
                                <div class="flex w-2/5 gap-3 pl-6">
                                    <!-- product -->
                                    <input type="hidden" value="{{ $item->product->id }}" name="products_id[]">
                                    <div class="w-fit">
                                        <div class="w-16 md:w-24 h-16 md:h-24 rounded-md overflow-hidden">
                                            <img class="w-full h-full object-cover"
                                                src="{{ Storage::url($item->product->image) }}" alt="">
                                            {{-- <input type="hidden" value="{{ $item->product->image }}"
                                                name="product_image[]"> --}}
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1 w-full">
                                        <span class="font-bold text-sm line-clamp-2">{{ $item->product->name }}</span>
                                        {{-- <input type="hidden" value="{{ $item->product->name }}" name="product_name[]">
                                        <input type="hidden" value="{{ $item->product->weight }}" name="weight[]"> --}}
                                        <span class="text-red-500 text-xs">{{ $item->product->category->name }}</span>
                                        <a href="/cart/{{ $item->id }}"
                                            class="font-semibold hover:text-red-500 text-slate-500 text-xs">Hapus</a>
                                    </div>
                                </div>
                                <div class="flex justify-center w-1/5">
                                    {{-- <button>
                                    <svg class="fill-current text-slate-600 w-3" viewBox="0 0 448 512">
                                        <path
                                            d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                    </svg>
                                </button> --}}

                                    <p class="mx-2 text-center w-12">{{ $item->qty }} pcs</p>
                                    <input type="hidden" value="{{ $item->qty }}" name="qty[]">

                                    {{-- <button>
                                    <svg class="fill-current text-slate-600 w-3" viewBox="0 0 448 512">
                                        <path
                                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                    </svg>
                                </button> --}}
                                </div>
                                <span class="text-center w-1/5 font-semibold text-sm">Rp
                                    {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                <span class="text-center w-1/5 font-semibold text-sm">Rp
                                    {{ number_format($item->qty * $item->product->price, 0, ',', '.') }}</span>
                                @php $total += $item->qty * $item->product->price @endphp
                            </div>
                        @endforeach

                        <a href="{{ url('/') }}" class="flex font-semibold text-indigo-600 text-sm mt-10">
                            <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                                <path
                                    d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                            </svg>
                            Lanjut belanja
                        </a>
                </div>

                <div id="summary"
                    class="w-1/4 px-4 lg:px-6 py-10 border border-indigo-200 rounded-md shadow-lg shadow-indigo-100 fixed right-5">
                    <h1 class="font-semibold text-2xl border-b pb-8">Ringkasan Pesanan</h1>

                    {{-- <div class="border-t mt-8"> --}}
                    <div class="flex font-semibold justify-between py-6 text-sm">
                        <span class="uppercase">Total</span>
                        <span class="font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        <input type="hidden" value="{{ $total }}" name="total">
                    </div>
                    <button onclick="window.location.href='{{ url('/checkout') }}';"
                        class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase rounded-md w-full">Checkout</button>
                    {{-- </div> --}}
                </div>
                </form>

            </div>
        @else
            <div class="flex flex-col pt-24 justify-center items-center gap-4">
                <div class="flex items-center w-64 h-64 rounded-lg rounded-tr-[60px] rounded-bl-[60px] overflow-hidden">
                    <img class="object-cover" src="{{ asset('assets/img/empty-cart.png') }}" alt="">
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
