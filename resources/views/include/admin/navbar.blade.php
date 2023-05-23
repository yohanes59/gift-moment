<nav class="fixed top-0 z-50 w-full bg-gradient-to-r from-indigo-500 to-indigo-600">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-slate-100 rounded-lg sm:hidden focus:outline-none focus:ring-1 focus:ring-indigo-900">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="#" class="flex ml-2 md:mr-24">
                    <img src="{{ asset('assets/img/logo_GiftMoment_putih.png') }}" class="h-8 mr-3" alt="logo GiftMoment" />
                    <span class="self-center text-lg font-semibold sm:text-xl whitespace-nowrap text-white">Admin GiftMoment</span>
                </a>
            </div>

            <div class="flex items-center">
                <div class="flex items-center ml-3">
                    <div>
                        <button type="button" class="flex text-sm rounded-full" aria-expanded="false"
                            data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <div class="flex items-center gap-2">
                                <div class="hidden sm:block text-white text-base font-medium">Hello, {{ Auth::user()->name }}</div>
                                <img class="w-8 h-8 rounded-full" src="{{ asset('assets/img/default.png') }}" alt="user photo">
                                <div class="text-white">
                                    <i class="fa-solid fa-caret-down"></i>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-slate-100 rounded shadow"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="block sm:hidden text-sm font-medium text-slate-900 truncate" role="none">
                                name : {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-slate-900 truncate" role="none">
                                email : {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-3" role="none">
                            <li>
                                <a href="{{ url('admin/profile') }}"
                                    class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100" role="menuitem">
                                    <span><i class="fa-solid fa-gear mr-1"></i></span>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100"
                                    role="menuitem">
                                    <span><i class="fa-solid fa-sign-out mr-1"></i></span>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
