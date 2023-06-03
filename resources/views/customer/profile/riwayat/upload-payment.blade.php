@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-[73px] md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div>Upload Bukti Pembayaran</div>
    
    <form action="/history/upload/{{ $transactionID }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="pay_amount" class="block mb-3 text-sm font-medium text-slate-900">Jumlah Transfer</label>
            <input type="number" name="pay_amount" id="pay_amount"
                class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5">
            @error('pay_amount')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            @if (isset($item) && $item->image)
                <img id="image-preview" src="{{ Storage::url($item->image) }}">
            @else
                <img id="image-preview">
            @endif
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-slate-900" for="image">Upload gambar</label>
            <input type="file" name="image"
                class="block w-full text-sm text-slate-900 border border-slate-400 rounded-md cursor-pointer bg-slate-100 focus:outline-none"
                id="image" onchange="previewImage()">
            @error('image')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
            <i class="fa-solid fa-check mr-1"></i>
            Kirim
        </button>
    </form>
@endsection
