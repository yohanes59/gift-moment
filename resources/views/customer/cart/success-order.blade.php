@extends('layouts.app')

@section('title', 'Cart')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-[73px] md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div class="container mx-auto mt-20">
        <div class="flex flex-col pt-24 justify-center items-center gap-4">
            <div class="flex items-center w-64 h-64 rounded-lg rounded-tr-[60px] rounded-bl-[60px] overflow-hidden">
                <img class="object-cover" src="{{ asset('assets/img/empty-cart.png') }}" alt="">
            </div>
            <div>
                <div class="text-xl text-center font-bold">Silahkan Transfer ke nomor rekening xxxxxxxxxx</div>
                <div class="text-base text-center text-slate-500">Agar orderanmu dapat segera di kirim ke tempatmu</div>
            </div>
            <a href="{{ url('/') }}"
                class="px-8 py-3 text-center text-white font-semibold bg-indigo-500 rounded-md hover:opacity-80 duration-300">
                Kembali Ke Beranda</a>
        </div>
    </div>
@endsection
