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
                    @php
                        $grandtotal_weight = 0;
                        foreach ($data['checkout_data'] as $product_id => $item_data) {
                            $grandtotal_weight += $item_data['total_weight'];
                        }
                    @endphp
                    <h3 class="mb-3 font-medium text-slate-900">Rincian Berat</h3>

                    <div class="text-slate-500">
                        Berat total :
                        <span class="text-slate-800 font-semibold">{{ number_format($grandtotal_weight, 0, ',', '.') }}
                            gr</span>
                    </div>
                </div>
                <div class="w-full p-4 border border-indigo-100 bg-white shadow-md shadow-indigo-100 rounded-md">
                    <form class="space-y-6" action="{{ url('/checkout/courier/cek-ongkir') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="courier" class="block mb-3 font-medium text-slate-900">Kurir</label>
                            <select name="courier"
                                class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                id="courier" required>
                                <option disabled selected>Pilih kurir</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
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
            @if ($ongkir != null)
                <div class="w-full max-w-md p-4 border border-indigo-100 bg-white shadow-md shadow-indigo-100 rounded-md">
                    <form class="space-y-6" action="{{ url('/checkout/courier/get-ongkir') }}" method="POST">
                        @csrf
                        <div>
                            <h3 class="mb-5 font-medium text-slate-900">Layanan pengiriman</h3>
                            <ul class="grid w-full gap-6 md:grid-rows-2">
                                @foreach ($ongkir['results'] as $item)
                                    <label for="name">Nama: {{ $item['name'] }}</label>
                                    <input type="hidden" name="courier_code" value="{{ $item['code'] }}">
                                    <input type="hidden" name="courier_name" value="{{ $item['name'] }}">
                                    <p>Service: </p>

                                    @foreach ($item['costs'] as $cost)
                                        <li>
                                            <input type="radio" id="{{ $cost['service'] }}" name="service[]"
                                                value="{{ $cost['service'] }}, {{ $cost['cost'][0]['value'] }}, {{ $cost['cost'][0]['etd'] }}"
                                                class="hidden peer" required>
                                            <label for="{{ $cost['service'] }}"
                                                class="inline-flex items-center justify-between w-full p-5 text-slate-500 bg-white border border-slate-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 peer-checked:bg-blue-50 hover:text-slate-600 hover:bg-slate-100">

                                                <div class="block">
                                                    <div class="w-full text-lg font-semibold">{{ $cost['service'] }}
                                                    </div>
                                                    <div class="w-full text-sm">Rp
                                                        {{ number_format($cost['cost'][0]['value'], 0, ',', '.') }} - 
                                                        (estimasi {{ $cost['cost'][0]['etd'] }} hari)
                                                    </div>
                                                </div>
                                            </label>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>

                        <button type="submit"
                            class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                            <i class="fa-solid fa-check mr-1"></i>
                            Pilih layanan
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
