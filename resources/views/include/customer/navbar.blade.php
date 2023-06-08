<nav class="bg-white fixed w-full z-50 top-0 left-0 border-b border-slate-200 shadow-lg">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-4 px-4 md:px-10">
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('assets/img/logo_GiftMoment.png') }}" class="h-8 mr-3" alt="Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap">GiftMoment</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-slate-500 rounded-lg md:hidden hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="flex flex-col p-4 md:p-0 mt-4 border border-slate-100 rounded-lg bg-slate-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                <li class="{{ request()->is('/') ? 'font-bold md:border-b-2 md:border-indigo-500 bg-indigo-100 md:bg-transparent' : '' }}">
                    <a href="{{ url('/') }}" class="block py-2 pl-3 pr-4 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Beranda</a>
                </li>
                <li class="{{ request()->is('about') ? 'font-bold md:border-b-2 md:border-indigo-500 bg-indigo-100 md:bg-transparent' : '' }}">
                    <a href="/about" class="block py-2 pl-3 pr-4 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Tentang Kami</a>
                </li>
                <li class="{{ request()->is('about-dev') ? 'font-bold md:border-b-2 md:border-indigo-500 bg-indigo-100 md:bg-transparent' : '' }}">
                    <a href="/about-dev" class="block py-2 pl-3 pr-4 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Tentang Pengembang</a>
                </li>

                @guest
                    <li>
                        <div class="flex items-center md:space-x-3">
                            <a href="{{ route('login') }}" class="block py-2 pl-3 pr-4 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                Masuk
                            </a>
                            <div class="block w-0.5 h-5 bg-slate-500"></div>
                            <a href="{{ route('register') }}" class="block py-2 pl-3 pr-4 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                Daftar
                            </a>
                        </div>
                    </li>
                @endguest

                @auth
                    <div class="flex items-center">
                        <div>
                            <button type="button" class="flex rounded-full" aria-expanded="false"
                                data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <div class="flex items-center gap-2 group">
                                    <div class="block py-2 pl-3 pr-4 text-slate-900 rounded group-hover:bg-slate-100 md:group-hover:bg-transparent md:border-0 md:group-hover:text-blue-700 md:p-0">Hello, {{ Auth::user()->name }}</div>
                                    
                                    <div class="text-slate-900 group-hover:bg-slate-100 md:group-hover:bg-transparent md:group-hover:text-blue-700">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-slate-100 rounded shadow-lg"
                            id="dropdown-user">
                            <ul class="py-3" role="none">
                                <li>
                                    <a href="/profile/{{ Auth::user()->id }}"
                                        class="block px-6 py-3 text-slate-700 hover:bg-slate-100" role="menuitem">
                                        <span><i class="fa-solid fa-user"></i></span>
                                        Edit Profil
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/history') }}"
                                        class="block px-6 py-3 text-slate-700 hover:bg-slate-100" role="menuitem">
                                        <span><i class="fa-solid fa-receipt mr-1"></i></span>
                                        Riwayat Pesanan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="block px-6 py-3 text-slate-700 hover:bg-slate-100"
                                        role="menuitem">
                                        <span><i class="fa-solid fa-sign-out mr-1"></i></span>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth
                <li>
                    <a href="{{ url('cart') }}" class="block py-2 pl-3 pr-4 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">
                        <i class="fa-solid fa-cart-shopping"></i> <span class="md:hidden ml-1 text-slate-900">Keranjang</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
  