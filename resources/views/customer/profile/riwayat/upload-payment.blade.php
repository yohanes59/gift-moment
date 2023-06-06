@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-[73px] md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div class="px-4 lg:px-10 mt-14 mx-auto w-full max-w-screen-xl">
        <div class="pt-1">
            <a href="{{ url('/history') }}" class="flex font-semibold text-indigo-600 text-sm mt-10">
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                    <path
                        d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="w-full mt-3 p-4 border border-indigo-100 bg-white shadow-md shadow-indigo-100 rounded-md">
            <div class="font-semibold text-lg">Upload Bukti Pembayaran</div>
            <div class="w-24 sm:w-36 h-0.5 bg-slate-500"></div>
            
            <div class="flex flex-col sm:flex-row sm:gap-4 mt-4">
                <div class="p-6 border border-indigo-200 rounded-md w-full sm:w-fit">
                    <div class="font-medium text-sm">Ringkasan</div>
                    <div class="text-sm w-fit mt-2">
                        @foreach ($data as $item)
                            <div class="flex text-slate-600">
                                <div class="w-28 flex justify-between mr-3">
                                    <span>Total Belanja</span>
                                    <span>: <span class="font-medium">Rp </span></span>
                                </div>
                                <div class="font-medium">{{ number_format($item->total, 0, ',', '.') }}</div>
                            </div>
    
                            <div class="flex text-slate-600 justify-between">
                                <div class="w-28 flex justify-between mr-3">
                                    <span>Biaya Ongkir</span>
                                    <span>: <span class="font-medium">Rp </span></span>
                                </div>
                                <div class="font-medium">{{ number_format($item->shipping_costs, 0, ',', '.') }}</div>
                            </div>
                            <div class="flex text-slate-600 justify-between">
                                <div class="w-28 flex justify-between mr-3">
                                    <span>Kode Unik</span>
                                    <span>: <span class="font-medium">Rp </span></span>
                                </div>
                                <div class="font-medium">{{ number_format($item->unique_payment_code, 0, ',', '.') }}</div>
                            </div>
                            <div class="w-full h-[1px] bg-slate-700 my-1.5"></div>
                            <div class="flex text-slate-600">
                                <div class="w-28 flex justify-between mr-3">
                                    <span>Subtotal</span>
                                    <span>: <span class="font-medium">Rp </span></span>
                                </div>
                                <div class="font-medium">{{ number_format($item->total + $item->shipping_costs + $item->unique_payment_code, 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="sm:w-full">
                    <form class="space-y-6" action="/history/upload/{{ $transactionID }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div>
                                <label for="pay_amount" class="block mb-3 text-sm font-medium text-slate-900">Jumlah Transfer</label>
                                <input type="number" name="pay_amount" id="pay_amount"
                                    class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5">
                                @error('pay_amount')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div>
                                <label class="block mb-2 text-sm font-medium text-slate-900" for="image">Upload gambar</label>
                                <input type="file" name="image"
                                    class="block w-full text-sm text-slate-900 border border-slate-400 rounded-md cursor-pointer bg-slate-100 focus:outline-none"
                                    id="image" onchange="previewImage()">
                                @error('image')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                                <div>
                                    @if (isset($item) && $item->image)
                                        <img id="image-preview" src="{{ Storage::url($item->image) }}">
                                    @else
                                        <img id="image-preview">
                                    @endif
                                </div>
                            </div>
                        </div>
                
                        <button type="submit"
                            class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                            <i class="fa-solid fa-check mr-1"></i>
                            Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
