@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-[73px] md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div>Riwayat Pesanan</div>
    {{ $data }}
    <br><br>
    {{ $payment }}
    <br><br>
    @foreach ($data as $item)
        <p>id pesanan: {{ $item->id }}</p>
        <p>tanggal pesan: {{ $item->created_at }}</p>
        <p>total: {{ $item->total + $item->shipping_costs }}</p>
        <p>status:
            @if ($item->payment_status == 'UNPAID')
                @if ($payment->where('transactions_id', $item->id)->first() !== null)
                    Menunggu Pembayaran Di Konfirmasi
                @else
                    Menunggu Pembayaran
                @endif
            @elseif ($item->payment_status == 'PAID')
                Pesanan Sedang Dikemas
                Pesanan Sedang Dikirimkan ke tempatmu
            @endif

            {{-- 
            
            Pesanan Sudah di terima --}}

        </p>
        <a href="/history/detail/{{ $item->id }}">detail pesanan</a>
        <a href="/history/upload/{{ $item->id }}">upload bukti pembayaran</a>
        <br><br>
    @endforeach
@endsection