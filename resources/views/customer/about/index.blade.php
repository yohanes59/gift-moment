@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-14 md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div class="px-4 lg:px-10 mx-auto w-full max-w-screen-xl">
        
        <!-- Breadcrumb -->
        <div class="pt-10 px-0 md:px-10">
            <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-white shadow-md" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tentang Kami</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        
        <section class="py-10 md:py-20 px-4 md:px-10">
            <div class="flex flex-col md:flex-row items-center md:items-start justify-center gap-5 md:gap-12">
                <div class="w-full max-w-xs">
                    <img src="{{ asset('assets/img/logo_GiftMoment_10.png') }}" alt="">
                </div>
                <div class="w-full max-w-xl">
                    <div class="flex flex-col gap-3">
                        <div class="w-16 h-1 bg-indigo-500 rounded-full"></div>
                        <div class="text-slate-900 text-justify">
                            <p>Selamat datang di GiftMoment!</p><br/>
                            <p>Kami adalah toko online yang berdedikasi untuk menyediakan perlengkapan dihari bahagia Anda. Dengan pengalaman kami dalam industri ini, kami mengerti betapa pentingnya momen-momen spesial dalam hidup Anda. Itulah mengapa kami hadir untuk membantu Anda menemukan barang-barang khusus yang akan menjadi kenang-kenangan berharga.</p><br/>
                            <p>Di GiftMoment, kami menyediakan beragam produk berkualitas tinggi dengan harga terjangkau. Kami mengutamakan keunikan dan keaslian dalam setiap item yang kami tawarkan. Mulai dari souvenir buatan tangan yang unik hingga produk menarik lainnya, kami memiliki pilihan yang sesuai dengan selera dan kebutuhan Anda.</p><br/>
                            <p>Kami juga menyadari betapa pentingnya momen pernikahan dalam hidup Anda. Oleh karena itu, kami dengan senang hati membantu Anda mencari barang kenang-kenangan yang sempurna untuk orang-orang terkasih yang terlibat dalam momen pernikahan Anda. Dengan kemudahan akses melalui perangkat seluler Anda, Anda dapat menjelajahi koleksi kami dengan mudah. Cukup kunjungi alamat web kami melalui browser ponsel Anda dan temukan berbagai souvenir dan mahar yang Anda cari.</p><br/>
                            <p>Kami berkomitmen untuk memberikan pengalaman belanja yang menyenangkan dan memuaskan bagi setiap pelanggan kami. Tim kami siap membantu Anda dalam setiap langkah perjalanan belanja Anda di GiftMoment.</p><br/>
                            <p>Terima kasih telah memilih kami sebagai sahabat momen bahagia Anda. Kami berharap dapat membuat setiap momen spesial dalam hidup Anda menjadi lebih berarti dan tak terlupakan.</p><br/>
                            <p>Selamat berbelanja di GiftMoment!</p><br/>
                            <p>Salam,<br/>Tim GiftMoment</p><br/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection