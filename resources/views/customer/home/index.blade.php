@extends('layouts.app')

@section('title', 'Beranda')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-8 md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    {{-- carousel --}}
    @include('components.carousel')

    <div class="px-4 lg:px-10 mx-auto w-full max-w-screen-xl">
        {{-- Kategori --}}
        <section class="py-4 px-4">
            <div class="text-xl md:text-2xl font-bold text-slate-900">Kategori</div>
            <div class="relative overflow-x-auto mt-3">
                <div class="w-full flex items-center space-x-3">
                    <div>
                        <a href="{{ url('/') }}"
                            class="py-3 px-5 flex items-center space-x-2 bg-slate-100 hover:bg-slate-200 duration-300 cursor-pointer rounded-md">
                            <svg aria-hidden="true" class="w-6 h-6 text-indigo-400 transition duration-75" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                            <div class="text-slate-900">Semua</div>
                        </a>
                    </div>
                    @foreach ($categories as $item)
                        <div>
                            <a href="{{ url('/category/' . $item->slug) }}"
                                class="py-3 px-5 flex items-center space-x-2 bg-slate-100 hover:bg-slate-200 duration-300 cursor-pointer">
                                <div class="w-7 h-7 overflow-hidden rounded-md">
                                    @if ($item->image != '')
                                        <img src="{{ asset(Storage::url($item->image)) }}" class="object-cover"
                                            alt="Gambar Produk {{ $item->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/img-kategori.png') }}" class="object-cover" alt="...">
                                    @endif
                                </div>
                                <div class="text-slate-900">{{ $item->name }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Produk --}}
        <section class="py-4 px-4">
            <div class="flex flex-col gap-3 sm:gap-0 sm:flex-row sm:justify-between sm:items-center">
                <div class="text-xl md:text-2xl font-bold text-slate-900">Produk</div>
                <div class="w-full max-w-sm lg:max-w-lg">
                    {{-- search --}}
                    <form action="{{ url('/search') }}" method="GET">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input name="search" type="search" value="{{ Request::get('search') }}" id="default-search"
                                class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Cari produk impianmu..." required>
                            <button type="submit"
                                class="text-white absolute right-2.5 bottom-2.5 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="flex flex-wrap gap-5 mt-3 mb-8">
                @foreach ($products as $item)
                    @if ($item->stock_amount == 0)
                        <a href="{{ url('/product/' . $item->slug) }}"
                            class="w-full max-w-[150px] md:max-w-[220px] lg:max-w-[290px] xl:max-w-[276px] flex flex-col gap-2 pb-2 border border-indigo-50 shadow-lg shadow-indigo-100 overflow-hidden rounded-md {{ $item->stock_amount == 0 ? 'pointer-events-none' : '' }}">
                            <div class="relative">
                                <div class="absolute top-12 left-6 md:top-24 md:left-[52px] lg:left-20 z-10">
                                    <div class="w-24 sm:w-28 h-24 sm:h-28 bg-indigo-950 rounded-full flex flex-col justify-center items-center text-white">
                                        <i class="fa-regular fa-face-sad-cry text-2xl sm:text-3xl"></i>
                                        <div class="font-medium text-sm">Stok Habis</div>
                                    </div>
                                </div>
                                <div class="w-full h-48 md:h-72 lg:h-80 {{ $item->stock_amount == 0 ? 'opacity-50' : '' }}">
                                    @if ($item->image != '')
                                        <img src="{{ asset(Storage::url($item->image)) }}"
                                            class="object-cover w-full h-48 md:h-72 lg:h-80"
                                            alt="Gambar Produk {{ $item->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/img-product.png') }}"
                                            class="object-cover w-full h-48 md:h-72 lg:h-80" alt="...">
                                    @endif
                                </div>
                                <div class="flex flex-col p-3 {{ $item->stock_amount == 0 ? 'opacity-50' : '' }}">
                                    <div class="w-fit bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">
                                        {{ $item->category->name }}</div>
                                    <div class="text-slate-900 line-clamp-1 sm:line-clamp-2">{{ $item->name }}</div>
                                    <div class="text-slate-900 font-bold">Rp{{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @else
                        <a href="{{ url('/product/' . $item->slug) }}"
                            class="w-full max-w-[150px] md:max-w-[220px] lg:max-w-[290px] xl:max-w-[276px] flex flex-col gap-2 pb-2 border border-indigo-50 shadow-lg shadow-indigo-100 overflow-hidden rounded-md {{ $item->stock_amount == 0 ? 'pointer-events-none opacity-50' : '' }}">
                            <div class="w-full h-48 md:h-72 lg:h-80">
                                @if ($item->image != '')
                                    <img src="{{ asset(Storage::url($item->image)) }}"
                                        class="object-cover w-full h-48 md:h-72 lg:h-80"
                                        alt="Gambar Produk {{ $item->name }}">
                                @else
                                    <img src="{{ asset('assets/img/img-product.png') }}"
                                        class="object-cover w-full h-48 md:h-72 lg:h-80" alt="...">
                                @endif
                            </div>
                            <div class="flex flex-col p-3">
                                <div class="w-fit bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">
                                    {{ $item->category->name }}</div>
                                <div class="text-slate-900 line-clamp-1 sm:line-clamp-2">{{ $item->name }}</div>
                                <div class="text-slate-900 font-bold">Rp{{ number_format($item->price, 0, ',', '.') }}
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
            <div>
                {{ $products->links() }}
            </div>
        </section>
    </div>

    {{-- FAQ --}}
    <section class="bg-indigo-50 py-20 px-4 flex justify-center">
        <div class="w-full max-w-screen-lg md:px-10">
            <div class="flex flex-col justify-center items-center gap-2 mb-8">
                <div class="text-center text-lg sm:text-2xl font-bold">Frequently Asked Question</div>
                <div class="w-24 sm:w-36 h-1 bg-indigo-300"></div>
            </div>

            <div id="faq" data-accordion="collapse">
                <div class="space-y-3">
                    @foreach ($faq as $item)
                        <div>
                            <h2 id="faq-heading-{{ $item->id }}">
                                <button type="button"
                                    class="bg-white flex items-center justify-between w-full p-5 font-medium text-left text-slate-900"
                                    data-accordion-target="#faq-body-{{ $item->id }}" aria-expanded="false"
                                    aria-controls="faq-body-{{ $item->id }}">
                                    <span class="pr-0.5">{!! $item->question !!}</span>
                                    <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </h2>
                            <div id="faq-body-{{ $item->id }}" class="hidden"
                                aria-labelledby="faq-heading-{{ $item->id }}">
                                <div class="p-5 bg-white">
                                    <div class="text-slate-900">{!! $item->answer !!}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('include.customer.footer')
@endsection

@section('backTop')
    <!-- Back to Top -->
    <a id="back-to-top" onclick="toTop()" class="fixed z-[9999] bottom-6 right-6 cursor-pointer hidden items-center justify-center w-14 h-14 bg-indigo-500 text-white text-xl rounded-full p-4">
        <i class="fa-solid fa-chevron-up"></i>
    </a>
@endsection