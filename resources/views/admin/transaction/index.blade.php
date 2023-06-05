@extends('layouts.app-admin')

@section('title', 'Transaksi')

@section('admin')
    <div class="mt-3">
        <div class="text-xl font-medium mb-8">List Transaksi</div>

        {{-- ALERT --}}
        @if ($message = Session::get('success'))
            <div id="alert-success" class="flex p-4 mb-4 bg-green-100 rounded-lg" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-base text-green-700">
                    {{ $message }}
                </div>
                <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8"
                    data-dismiss-target="#alert-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="w-16 py-3 px-6">
                            ID
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Tanggal Transaksi
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nama
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Total
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Status Pembayaran
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Status Pesanan
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    className: 'py-3 px-6 text-center whitespace-nowrap',
                    width: '5%',
                    render: function(data, type, row) {
                        return data.substr(data.length - 8);
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    className: 'py-4 px-6 whitespace-nowrap',
                    width: '10%',
                    render: function(data, type, row) {
                        const date = new Date(data);
                        const formattedDate = date.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                        });
                        return formattedDate.replace('pukul', '-');
                    }
                },
                {
                    data: 'user.name',
                    name: 'user.name',
                    className: 'py-3 px-6',
                    width: '20%'
                },
                {
                    data: 'total',
                    name: 'total',
                    className: 'py-3 px-6',
                    width: '15%',
                    render: function(data, type, row) {
                        return 'Rp ' + new Intl.NumberFormat('id-ID', {
                            minimumFractionDigits: 0
                        }).format(data);
                    }
                },
                {
                    data: 'payment_status',
                    name: 'payment_status',
                    className: 'py-3 px-6 text-center',
                    width: '20%',
                },
                {
                    data: 'order_status',
                    name: 'order_status',
                    className: 'py-3 px-6',
                    width: '20%',
                    render: function(data, type, row) {
                        if (data === null) {
                            return 'Menunggu Konfirmasi Pembayaran';
                        } else if (data === 'CANCELLED') {
                            return 'Pesanan Tidak Dibayar';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'py-3 px-6',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        })

        $('table').on('draw.dt', function() {
            $('[data-bs-toggle="tooltip-detail"]').tooltip();
        })
    </script>
@endpush
