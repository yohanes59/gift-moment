@extends('layouts.app')

@section('title', 'Pilih Kurir')

@section('content')
    <div class="px-4 lg:px-10 mt-14 mx-auto w-full max-w-screen-xl">
        <div>
            <a href="{{ url('/checkout') }}" class="flex font-semibold text-indigo-600 text-sm mt-10">
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                    <path
                        d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="w-full flex flex-col md:flex-row gap-6 mt-3 p-4">
            {{-- pilih kurir --}}
            <div class="w-full max-w-sm flex flex-col gap-3">
                <div class="w-full p-4 border border-indigo-100 bg-white shadow-md shadow-indigo-100 rounded-md">
                    <h3 class="mb-3 font-medium text-slate-900">Rincian pesanan</h3>
                    <div class="text-slate-500">
                        Jumlah barang : 
                        <span class="text-slate-800 font-semibold">21</span>
                    </div>

                    <div class="text-slate-500">
                        Berat total : 
                        <span class="text-slate-800 font-semibold">2400 gr</span>
                    </div>
                </div>
                <div class="w-full p-4 border border-indigo-100 bg-white shadow-md shadow-indigo-100 rounded-md">
                    {{-- <form class="space-y-6" action="{{ route('user.profile', ['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data"> --}}
                    <form class="space-y-6" action="" method="POST" enctype="multipart/form-data">
                        {{-- @csrf
                        @if (isset($data))
                            @method('PUT')
                        @endif --}}
                        <div>
                            <label for="courier" class="block mb-3 font-medium text-slate-900">Kurir</label>
                            <select name="courier" class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                id="courier" required>
                                <option disabled selected>Pilih kurir</option>
                                {{-- @foreach ($category as $data)
                                    <option value="{{ $data->id }}"
                                        {{ isset($item) ? ($item->courier == $data->id ? 'selected' : '') : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach --}}
                                <option value="">JNE</option>
                                <option value="">POS</option>
                                <option value="">TIKI</option>
                            </select>
                            @error('courier')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <button type="submit"
                            class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                            Pilih jenis kurir
                        </button>
                    </form>
                </div>
            </div>

            {{-- pilih service --}}
            <div class="w-full max-w-md p-4 border border-indigo-100 bg-white shadow-md shadow-indigo-100 rounded-md">
                <form class="space-y-6" action="">
                    <div>
                        <h3 class="mb-5 font-medium text-slate-900">Layanan pengiriman</h3>
                        <ul class="grid w-full gap-6 md:grid-rows-2">
                            <li>
                                <input type="radio" id="hosting-small" name="hosting" value="hosting-small" class="hidden peer" required>
                                <label for="hosting-small" class="inline-flex items-center justify-between w-full p-5 text-slate-500 bg-white border border-slate-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 peer-checked:bg-blue-50 hover:text-slate-600 hover:bg-slate-100">                           
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">OKE</div>
                                        <div class="w-full text-sm">Rp 15.000 (estimasi 3-6 hari)</div>
                                    </div>
                                </label>
                            </li>

                            <li>
                                <input type="radio" id="hosting-big" name="hosting" value="hosting-big" class="hidden peer">
                                <label for="hosting-big" class="inline-flex items-center justify-between w-full p-5 text-slate-500 bg-white border border-slate-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 peer-checked:bg-blue-50 hover:text-slate-600 hover:bg-slate-100">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">REG</div>
                                        <div class="w-full text-sm">Rp 20.000 (estimasi 3-6 hari)</div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <button type="submit"
                        class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                        <i class="fa-solid fa-check mr-1"></i>
                        Pilih layanan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection