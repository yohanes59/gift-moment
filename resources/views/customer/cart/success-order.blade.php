@extends('layouts.app')

@section('title', 'Cart')

@section('navbar')
    @include('include.customer.navbar')
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex flex-col pt-24 justify-center items-center gap-4">
            <div class="flex items-center w-96 h-96 rounded-lg overflow-hidden">
                <img class="object-cover" src="{{ asset('assets/img/cart/order-success.svg') }}" alt="">
            </div>
            <div>
                <div class="text-xl text-center font-bold">Silahkan Transfer ke {{ $adminData->account_number }} sebesar Rp
                    {{ number_format($data->total + $data->shipping_costs + $data->unique_payment_code, 0, ',', '.') }}</div>
                <div class="text-base text-center text-slate-500">Agar orderanmu dapat segera di kirim ke tempatmu</div>
            </div>
            <a href="{{ url('/') }}"
                class="w-56 px-8 py-3 text-center text-white font-semibold bg-indigo-500 rounded-md hover:opacity-80 duration-300">
                Kembali Ke Beranda
            </a>
            <a href="{{ url('/history') }}"
                class="w-56 px-8 py-3 text-center text-indigo-500 font-semibold border border-indigo-500 hover:bg-indigo-500 hover:text-white rounded-md duration-300">
                Lihat pesananmu
            </a>
        </div>
    </div>
@endsection
