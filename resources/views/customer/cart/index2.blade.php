@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container mx-auto mt-20">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                    <h2 class="font-semibold text-2xl">{{ count($cart) }} Items</h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Subtotal</h3>
                </div>

                @php $total = 0 @endphp
                @foreach ($cart as $item)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                        <div class="flex w-2/5">
                            <!-- product -->
                            <div class="w-20">
                                <img class="h-24" src="{{ Storage::url($item->product->image) }}" alt="">
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm">{{ $item->product->name }}</span>
                                <span class="text-red-500 text-xs">{{ $item->product->category->name }}</span>
                                <a href="/cart/{{ $item->id }}"
                                    class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5">
                            {{-- <button>
                                <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                                    <path
                                        d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                </svg>
                            </button> --}}

                            <p class="mx-2 text-center w-12">{{ $item->qty }} pcs</p>

                            {{-- <button>
                                <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                                    <path
                                        d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                </svg>
                            </button> --}}
                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">Rp.
                            {{ number_format($item->product->price, 0, ',', '.') }}</span>
                        <span class="text-center w-1/5 font-semibold text-sm">Rp.
                            {{ number_format($item->qty * $item->product->price, 0, ',', '.') }}</span>
                        @php $total += $item->qty * $item->product->price @endphp
                    </div>
                @endforeach

                <a href="{{ url('/') }}" class="flex font-semibold text-indigo-600 text-sm mt-10">
                    <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                        <path
                            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                    </svg>
                    Continue Shopping
                </a>
            </div>

            <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                {{-- <div class="flex justify-between mt-10 mb-5"> --}}
                    {{-- <span class="font-semibold text-sm uppercase">Total Items {{ count($cart) }}</span> --}}
                    {{-- <span class="font-semibold text-sm">Rp. {{ number_format($total, 0, ',', '.') }}</span> --}}
                {{-- </div> --}}

                {{-- <div class="border-t mt-8"> --}}
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <button
                        class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
                {{-- </div> --}}
            </div>

        </div>
    </div>
@endsection
