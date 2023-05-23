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
            @foreach ($category as $item)
            <div class="py-3 px-5 flex items-center space-x-2 bg-slate-100 hover:bg-slate-200 duration-300 cursor-pointer rounded-md">
                <div class="w-7 h-7">
                    @if ($item->image != '')
                                    <img src="{{ asset(Storage::url($item->image)) }}" class="card-img-top"
                                    height="200" alt="Gambar Produk {{ $item->name }}">
                            @else
                                    <img src="{{ asset('assets/img/img-kategori.png') }}" class="card-img-top" alt="...">
                        @endif
                </div>
                <div class="text-slate-900">{{$item->name}}</div>
            </div>
            @endforeach
        </div>
    </section>

        {{-- Produk --}}
        <section class="py-4 px-4">
            <div class="text-xl md:text-2xl font-bold text-slate-900">Produk</div>
            <div class="flex flex-wrap gap-5 mt-3 mb-8">
                @foreach ($product as $items)
                <div class="w-full max-w-[150px] lg:max-w-[270px] flex flex-col gap-2 pb-2 shadow-lg rounded-md">
                    <div>
                        @if ($items->image != '')
                                    <img src="{{ asset(Storage::url($items->image)) }}" class="card-img-top"
                                    height="200" alt="Gambar Produk {{ $items->name }}">
                            @else
                                    <img src="{{ asset('assets/img/img-product.png') }}" class="card-img-top" alt="...">
                        @endif
                    </div>
                    <div class="flex flex-col p-3">
                        <div class="w-fit bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">{{$items->category->name}}</div>
                        <div class="text-slate-900 line-clamp-2">{{$items->name}}</div>
                        <div class="text-slate-900 font-bold">Rp{{ number_format($items->price, 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach
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
                        {{-- 
                            -> angka di faq-heading-1 & faq-body-1 diganti ID FAQ    
                        --}}
                        <h2 id="faq-heading-1"> 
                            <button type="button" class="bg-white flex items-center justify-between w-full p-5 font-medium text-left text-slate-900" data-accordion-target="#faq-body-1" aria-expanded="false" aria-controls="faq-body-1">
                                <span class="pr-0.5">Lorem ipsum dolor sit amet consectetur. Egestas pellentesque eget nunc tortor?</span>
                                <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </h2>
                        <div id="faq-body-1" class="hidden" aria-labelledby="faq-heading-1">
                            <div class="p-5 bg-white">
                                <p class="text-slate-900">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, quisquam? Deleniti, quibusdam impedit! At architecto repellat tempore consectetur dolorem fugiat minus a placeat amet! Fuga nesciunt explicabo ad hic assumenda!</p>
                            </div>
                        </div>
                    </div>

                    {{-- Hapus data statis start --}}
                    <div>
                        <h2 id="faq-heading-2">
                            <button type="button" class="bg-white flex items-center justify-between w-full p-5 font-medium text-left text-slate-900" data-accordion-target="#faq-body-2" aria-expanded="false" aria-controls="faq-body-2">
                                <span class="pr-0.5">Lorem ipsum dolor sit amet consectetur. Egestas pellentesque eget nunc tortor?</span>
                                <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </h2>
                        <div id="faq-body-2" class="hidden" aria-labelledby="faq-heading-2">
                            <div class="p-5 bg-white">
                                <p class="text-slate-900">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, quisquam? Deleniti, quibusdam impedit! At architecto repellat tempore consectetur dolorem fugiat minus a placeat amet! Fuga nesciunt explicabo ad hic assumenda!</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 id="faq-heading-3">
                            <button type="button" class="bg-white flex items-center justify-between w-full p-5 font-medium text-left text-slate-900" data-accordion-target="#faq-body-3" aria-expanded="false" aria-controls="faq-body-3">
                                <span class="pr-0.5">Lorem ipsum dolor sit amet consectetur. Egestas pellentesque eget nunc tortor?</span>
                                <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </h2>
                        <div id="faq-body-3" class="hidden" aria-labelledby="faq-heading-3">
                            <div class="p-5 bg-white">
                                <p class="text-slate-900">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, quisquam? Deleniti, quibusdam impedit! At architecto repellat tempore consectetur dolorem fugiat minus a placeat amet! Fuga nesciunt explicabo ad hic assumenda!</p>
                            </div>
                        </div>
                    </div>
                    {{-- Hapus data statis end --}}
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('include.customer.footer')
@endsection