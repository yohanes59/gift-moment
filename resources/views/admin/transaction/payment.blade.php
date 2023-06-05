@extends('layouts.app-admin')

@section('title', 'Bukti Pembayaran')

@section('admin')
    <div class="mt-3">
        <div class="mb-8">
            <x-link to="{{ url('admin/transaction') }}" size="lg" icon="fa-chevron-left mr-1" text="Kembali"
                padding="py-2 px-4" color="blue" />
        </div>
        <div class="flex gap-3">
            <div class="w-fit mb-3">
                <div class="flex flex-col bg-white py-2 pl-2 pr-6 space-y-2">
                    <div class="w-fit text-green-800 text-md px-2.5 py-1 rounded">ID Transaksi :
                        <span class="font-medium">{{ substr($paymentData->transactions_id, -8) }}</span>
                    </div>
                    <div class="w-fit text-green-800 text-md px-2.5 py-1 rounded">Jumlah Bayar :
                        <span class="font-medium">Rp. {{ number_format($paymentData->pay_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <div>
                <div class="w-fit bg-white text-green-800 text-md font-medium px-2.5 py-1 rounded">Bukti Bayar :
                    <div class="w-52 mt-2 cursor-pointer hover:brightness-50 duration-300" data-modal-target="buktiPembayaran" data-modal-toggle="buktiPembayaran" data-tooltip-target="bukti-bayar">
                        <img src="{{ Storage::url($paymentData->image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="buktiPembayaran" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Bukti Pembayaran
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="buktiPembayaran">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <img src="{{ Storage::url($paymentData->image) }}" alt="">
                </div>
            </div>
        </div>
    </div>

    {{-- tooltip --}}
    <div id="bukti-bayar" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Lihat Bukti Pembayaran
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
@endsection
