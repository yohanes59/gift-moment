@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- carousel --}}
    @include('components.carousel')

    <div class="px-4 lg:px-10 mx-auto w-full max-w-screen-xl">
        {{-- Kategori --}}
        <section class="py-4 px-4">
            <div class="text-xl md:text-2xl font-bold text-slate-900">Kategori</div>
            <div class="overflow-x-auto flex items-center space-x-3 mt-3">
                <a href="{{ url('/') }}"
                    class="py-3 px-5 flex items-center space-x-2 bg-slate-100 hover:bg-slate-200 duration-300 cursor-pointer rounded-md">
                    <svg aria-hidden="true" class="w-6 h-6 text-indigo-400 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <div class="text-slate-900">Semua</div>
                </a>
                @foreach ($categories as $item)
                    <a href="{{ url('/category/' . $item->slug) }}"
                        class="py-3 px-5 flex items-center space-x-2 bg-slate-100 hover:bg-slate-200 duration-300 cursor-pointer">
                        <div class="w-7 h-7 overflow-hidden rounded-md">
                            @if ($item->image != '')
                                <img src="{{ asset(Storage::url($item->image)) }}" class="object-cover" alt="Gambar Produk {{ $item->name }}">
                            @else
                                <img src="{{ asset('assets/img/img-kategori.png') }}" class="object-cover" alt="...">
                            @endif
                        </div>
                        <div class="text-slate-900">{{ $item->name }}</div>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- Produk --}}
        <section class="py-4 px-4">
            <div class="text-xl md:text-2xl font-bold text-slate-900">Produk</div>
            <div class="flex flex-wrap gap-5 mt-3 mb-8">
                @foreach ($products as $item)
                    <a href="{{ url('/product/' . $item->slug) }}" class="w-full max-w-[150px] lg:max-w-[270px] md:max-w-[220px] flex flex-col gap-2 pb-2 shadow-lg overflow-hidden rounded-md">
                        <div class="w-full h-48 md:h-72 lg:h-80">
                            @if ($item->image != '')
                                <img src="{{ asset(Storage::url($item->image)) }}" class="object-cover w-full h-48 md:h-72 lg:h-80" alt="Gambar Produk {{ $item->name }}">
                            @else
                                <img src="{{ asset('assets/img/img-product.png') }}" class="object-cover w-full h-48 md:h-72 lg:h-80" alt="...">
                            @endif
                        </div>
                        <div class="flex flex-col p-3">
                            <div class="w-fit bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">
                                {{ $item->category->name }}</div>
                            <div class="text-slate-900 line-clamp-2">{{ $item->name }}</div>
                            <div class="text-slate-900 font-bold">Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                        </div>
                    </a>
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
                    <div>
                        @foreach ($faq as $item)
                        <h2 id="faq-heading-{{ $item->id }}">
                            <button type="button"
                                class="bg-white flex items-center justify-between w-full p-5 font-medium text-left text-slate-900"
                                data-accordion-target="#faq-body-{{ $item->id }}" aria-expanded="false" aria-controls="faq-body-{{ $item->id }}">
                                <span class="pr-0.5">
                                    {{ $item->question }}</span>
                                <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </h2>
                        <div id="faq-body-{{ $item->id }}" class="hidden" aria-labelledby="faq-heading-{{ $item->id }}">
                            <div class="p-5 bg-white">
                                <p class="text-slate-900">{{ $item->answer }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{-- Hapus data statis end --}}
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('include.customer.footer')
@endsection
