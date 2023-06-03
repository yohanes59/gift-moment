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
            {{-- @if ($item->payment_status == 'CANCELLED'){
                Pesanan Dibatalkan
                } --}}
            @if ($item->payment_status == 'UNPAID')
                @if ($payment->where('transactions_id', $item->id)->first() !== null)
                    Menunggu Pembayaran Di Konfirmasi
                @endif
            @elseif ($item->payment_status == 'PAID')
                @if ($item->order_status == 'NEW_ORDER')
                    Pesanan Sedang Diproses
                @elseif ($item->order_status == 'PACKED')
                    Pesanan Menunggu Jasa Kurir
                @elseif ($item->order_status == 'SHIPPED')
                    Pesanan Sedang Dikirimkan ke tempatmu
                @elseif ($item->order_status == 'COMPLETED')
                    Pesanan Selesai
                @else
                    <a href="">Terima Pesanan</a>
                @endif
            @endif
        </p>
        <a href="/history/detail/{{ $item->id }}">detail pesanan</a>

        @if ($item->payment_status == 'UNPAID')
            <a href="/history/upload/{{ $item->id }}">upload bukti pembayaran</a>
        @elseif ($item->order_status == 'SHIPPED')
            <a href="/history/confirmOrderStatus/{{ $item->id }}">Konfirmasi Pesanan</a>
        @endif
        <br><br>
    @endforeach
@endsection
