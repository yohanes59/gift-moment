<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-4 transition-transform -translate-x-full bg-white shadow-lg sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white">
        <ul class="mt-5 space-y-2 font-medium">
            <li class="{{ request()->is('admin/dashboard') ? 'bg-indigo-100 rounded-lg' : '' }}">
                <a href="{{ url('admin/dashboard') }}" class="flex items-center p-3 rounded-lg text-slate-800 hover:bg-indigo-100">
                    <svg aria-hidden="true" class="w-6 h-6 text-indigo-400 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/category') ? 'bg-indigo-100 rounded-lg' : '' }}">
                <a href="{{ url('admin/category') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
                    <svg aria-hidden="true" class="w-6 h-6 text-indigo-400 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Kategori</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/product') ? 'bg-indigo-100 rounded-lg' : '' }}">
                <a href="{{ url('admin/product') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
                    <i class="fa-solid fa-fw fa-boxes-stacked text-indigo-400"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Produk</span>
                </a>
            </li>
            
            <li>
                <button type="button" class="flex items-center w-full p-3 rounded-lg text-slate-800 hover:bg-indigo-100" aria-controls="dropdown-stock" data-collapse-toggle="dropdown-stock">
                    <i class="fa-solid fa-fw fa-dolly text-indigo-400"></i>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Stok</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <ul id="dropdown-stock" class="{{ request()->is('admin/stock/*') ? '' : 'hidden' }} py-2 px-4 space-y-1">
                      <li class="{{ request()->is('admin/stock/masuk') ? 'bg-indigo-100 rounded-lg' : '' }}">
                         <a href="{{ url('admin/stock/masuk') }}" class="flex items-center w-full text-sm p-3 rounded-lg text-slate-800 hover:bg-indigo-100">Stok Masuk</a>
                      </li>

                      <li class="{{ request()->is('admin/stock/keluar') ? 'bg-indigo-100 rounded-lg' : '' }}">
                         <a href="{{ url('admin/stock/keluar') }}" class="flex items-center w-full text-sm p-3 rounded-lg text-slate-800 hover:bg-indigo-100">Stok Keluar</a>
                      </li>
                </ul>
            </li>
            
            <li class="{{ request()->is('admin/transaction') ? 'bg-indigo-100 rounded-lg' : '' }}">
                <a href="{{ url('admin/transaction') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
                    <i class="fa-solid fa-fw fa-money-bills text-indigo-400"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Transaksi</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/faq') ? 'bg-indigo-100 rounded-lg' : '' }}">
                <a href="{{ url('admin/faq') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
                    <i class="fa-solid fa-fw fa-circle-question text-indigo-400"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">FAQ</span>
                </a>
            </li>
        </ul>
    </div>
 </aside>