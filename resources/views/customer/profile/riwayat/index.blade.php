@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-[73px] md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div class="px-4 lg:px-10 pb-24 mx-auto w-full max-w-screen-xl">
        <!-- Breadcrumb -->
        <div class="py-4 sm:py-10">
            <nav class="flex px-5 py-3 text-slate-700 border border-indigo-200 rounded-lg bg-white shadow-md shadow-indigo-100"
                aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-indigo-600">
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
                            <svg aria-hidden="true" class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2">Akun</span>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2">Riwayat Pesanan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        @if ($data->count() > 0)
            @foreach ($data as $item)
                <div class="w-full p-4 border border-indigo-200 rounded-md mb-4">
                    <div class="flex flex-col gap-2 sm:gap-0 sm:flex-row justify-start sm:justify-between items-start sm:items-center">
                        <div class="w-full sm:w-fit flex justify-between text-sm font-medium order-1 sm:-order-1">
                            <div>
                                <i class="fa-solid fa-bag-shopping mr-1 text-indigo-500"></i>
                                Transaksi :
                            </div>
                            <div class="font-normal">
                                {{ $item->created_at->format('d M Y - H:i') }}
                            </div>
                        </div>

                        <div class="w-full sm:w-fit text-center">
                            @if ($item->payment_status == 'UNPAID')
                                @if ($payment->where('transactions_id', $item->id)->first() !== null)
                                    <div
                                        class="w-full bg-amber-100 text-amber-800 text-xs font-medium mr-2 px-2.5 py-1 rounded">Menunggu
                                        konfirmasi</div>
                                @else
                                    <div
                                        class="w-full bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-1 rounded">Belum
                                        bayar</div>
                                @endif
                            @elseif ($item->payment_status == 'PAID')
                                @if ($item->order_status == 'NEW_ORDER')
                                    <div
                                        class="w-full bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-1 rounded">
                                        Pesanan Sedang Diproses
                                    </div>
                                @elseif ($item->order_status == 'PACKED')
                                    <div
                                        class="w-full bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-1 rounded">
                                        Pesanan Menunggu Jasa Kurir
                                    </div>
                                @elseif ($item->order_status == 'SHIPPED')
                                    <div
                                        class="w-full bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-1 rounded">
                                        Pesanan Sedang Dikirimkan ke tempatmu
                                    </div>
                                @elseif ($item->order_status == 'COMPLETED')
                                    <div
                                        class="w-full bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-1 rounded">
                                        Pesanan Selesai
                                    </div>
                                @else
                                    <a href=""
                                        class="px-6 py-3 text-white font-bold bg-green-500 hover:opacity-80 duration-300 rounded-md">Terima
                                        Pesanan</a>
                                @endif
                            @elseif ($item->order_status == 'CANCELLED')
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                    Pesanan Dibatalkan
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row justify-between">
                        <div>
                            <div class="flex justify-between sm:justify-start gap-2 text-slate-500">
                                <div>ID Pesanan :</div>
                                <div class="font-medium">{{ substr($item->id, -8) }}</div>
                            </div>

                            <div class="flex flex-row sm:flex-col justify-between sm:justify-start">
                                <div>Total</div>
                                <div class="font-bold">Rp
                                    {{ number_format($item->total + $item->shipping_costs + $item->unique_payment_code, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        {{-- button --}}
                        <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row items-start sm:items-end gap-2 text-sm">
                            <div class="w-full sm:w-fit text-center text-indigo-500 bg-indigo-50 rounded-md font-bold hover:opacity-80">
                                <a class="block w-full p-3" href="/history/detail/{{ $item->id }}">Detail Pesanan</a>
                            </div>
                            @if ($payment->where('transactions_id', $item->id)->first() == null)
                                @if ($item->order_status !== 'CANCELLED')
                                    <div class="w-full sm:w-fit text-center text-white font-bold bg-indigo-500 hover:opacity-80 duration-300 rounded-md">
                                        <a class="block w-full px-4 py-3" href="/success-order/{{ $item->id }}">Bayar Sekarang</a>
                                    </div>
                                @endif
                            @endif

                            @if ($item->payment_status == 'UNPAID')
                                @if ($payment->where('transactions_id', $item->id)->first() !== null)
                                    <div class="w-full sm:w-fit text-center border border-indigo-500 text-indigo-500 hover:opacity-80 duration-300 rounded-md">
                                        <a class="block w-full px-4 py-3" href="https://api.whatsapp.com/send?phone={{ $userData['phone_number'] }}&text=Hallo%20admin,%20saya%20mau%20tanya"
                                            target="_blank" data-tooltip-target="tooltip-chat">
                                            <i class="fa-solid fa-comment-dots mr-1 sm:mr-0"></i>
                                            <span class="sm:hidden">Tanya Penjual</span>
                                        </a>
                                    </div>
                                @else
                                    <div class="w-full sm:w-fit text-center border border-indigo-500 text-indigo-500 font-medium hover:bg-indigo-500 hover:text-white duration-300 rounded-md">
                                        <a class="block w-full px-4 py-3" href="/history/upload/{{ $item->id }}">Upload Bukti Pembayaran</a>
                                    </div>
                                @endif

                            @elseif($item->payment_status == 'PAID')
                                @if ($item->order_status == 'NEW_ORDER' || $item->order_status == 'PACKED')
                                <div class="w-full sm:w-fit text-center border border-indigo-500 text-indigo-500 hover:opacity-80 duration-300 rounded-md">
                                    <a class="block w-full px-4 py-3" href="https://api.whatsapp.com/send?phone={{ $userData['phone_number'] }}&text=Hallo%20admin,%20saya%20mau%20tanya"
                                        target="_blank" data-tooltip-target="tooltip-chat">
                                        <i class="fa-solid fa-comment-dots mr-1 sm:mr-0"></i>
                                        <span class="sm:hidden">Tanya Penjual</span>
                                    </a>
                                </div>
                                @elseif ($item->order_status == 'SHIPPED')
                                    <a class="block w-full px-4 py-3" href="/history/confirmOrderStatus/{{ $item->id }}"
                                        class="text-white font-bold bg-indigo-500 hover:opacity-80 duration-300 rounded-md">Konfirmasi
                                        Pesanan</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $data->links() }}
        @else
            <div class="flex flex-col justify-center items-center gap-4">
                <div class="flex items-center w-72 h-72 rounded-lg rounded-tr-[60px] rounded-bl-[60px] overflow-hidden">
                    <img class="object-cover" src="{{ asset('assets/img/cart/no-order.svg') }}" alt="">
                </div>
                <div>
                    <div class="text-xl text-center font-bold">Kamu belum pernah melakukan transaksi</div>
                    <div class="text-base text-center text-slate-500">Temukan produk kebutuhanmu bersama kami</div>
                </div>
                <a href="{{ url('/') }}"
                    class="px-8 py-3 text-center text-white font-semibold bg-indigo-500 rounded-md hover:opacity-80 duration-300">Jelajahi
                    Sekarang</a>
            </div>
        @endif

    </div>

    <div id="tooltip-chat" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
        Tanya Penjual
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
@endsection

@section('backTop')
    <!-- Back to Top -->
    <a id="back-to-top" onclick="toTop()" class="fixed z-[9999] bottom-6 right-6 cursor-pointer hidden items-center justify-center w-14 h-14 bg-indigo-500 text-white text-xl rounded-full p-4">
        <i class="fa-solid fa-chevron-up"></i>
    </a>
@endsection