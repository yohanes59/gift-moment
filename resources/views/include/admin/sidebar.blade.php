<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-4 transition-transform -translate-x-full bg-indigo-800 border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-indigo-800">
        <div class="flex items-center pl-2.5 mb-5">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-7" alt="BB Comp Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Admin BB Comp</span>
        </div>
        <ul class="space-y-2 font-medium">
            <li class="{{ request()->is('admin/dashboard') ? 'bg-indigo-900' : '' }}">
                <a href="{{ url('admin/dashboard') }}" class="flex items-center p-3 rounded-lg text-white hover:bg-indigo-900">
                    <svg aria-hidden="true" class="w-6 h-6 text-white transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/category') ? 'bg-indigo-900' : '' }}">
                <a href="{{ url('admin/category') }}" class="flex items-center p-3 text-white rounded-lg text-white hover:bg-indigo-900">
                    <svg aria-hidden="true" class="w-6 h-6 text-white transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Kategori</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/product') ? 'bg-indigo-900' : '' }}">
                <a href="{{ url('admin/product') }}" class="flex items-center p-3 text-white rounded-lg text-white hover:bg-indigo-900">
                    <i class="fa-solid fa-fw fa-boxes-stacked"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Produk</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/transaction') ? 'bg-indigo-900' : '' }}">
                <a href="{{ url('admin/transaction') }}" class="flex items-center p-3 text-white rounded-lg text-white hover:bg-indigo-900">
                    <i class="fa-solid fa-fw fa-money-bills"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Transaksi</span>
                </a>
            </li>
        </ul>
    </div>
 </aside>