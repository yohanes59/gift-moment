@extends('layouts.app-admin')

@section('title', 'Bukti Pembayaran')

@section('admin')
    <div class="mt-3">
        <div class="mb-8">
            <x-link to="{{ url('admin/transaction') }}" size="lg" icon="fa-chevron-left mr-1" text="Kembali"
                padding="py-2 px-4" color="blue" />
        </div>
        <div class="flex flex-col space-y-2 mb-3">
            <div class="w-fit bg-green-100 text-green-800 text-md font-medium px-2.5 py-1 rounded">ID Transaksi :
                {{ substr($paymentData->transactions_id, -8) }}</div>
            <div class="w-fit bg-green-100 text-green-800 text-md font-medium px-2.5 py-1 rounded">Jumlah Bayar :
                Rp. {{ number_format($paymentData->pay_amount, 0, ',', '.') }}
            </div>
            <div class="w-fit bg-green-100 text-green-800 text-md font-medium px-2.5 py-1 rounded">Bukti Bayar :
                <img src="{{ Storage::url($paymentData->image) }}" alt="">
            </div>
        </div>
    </div>
@endsection
