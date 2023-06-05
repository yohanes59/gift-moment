@extends('layouts.app-admin')

@section('title', 'Riwayat Stok')

@section('admin')
    <div class="mt-3">
        <div class="text-xl font-medium mb-8">List Riwayat Stok</div>

        {{-- Filter --}}
        <div class="flex items-center mb-4">
            <label for="start_date" class="mr-2">Tanggal Awal:</label>
            <input type="date" id="start_date" name="start_date" class="border border-gray-300 rounded px-2 py-1">
            <label for="end_date" class="ml-4 mr-2">Tanggal Akhir:</label>
            <input type="date" id="end_date" name="end_date" class="border border-gray-300 rounded px-2 py-1">
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="py-3 px-6">
                            Gambar
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nama Produk
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Tanggal
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Masuk
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Keluar
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y"></tbody>
            </table>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var datatable;

        function applyDateFilter() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            datatable.columns(2).search(startDate + '|' + endDate, true, false).draw(); 
        }

        $(document).ready(function() {
            datatable = $('#crudTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [
                    {
                        data: 'image',
                        name: 'image',
                        className: 'py-4 px-6',
                        width: '10%',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'product.name',
                        name: 'product.name',
                        className: 'py-4 px-6',
                        width: '20%',
                        searchable: true
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
                        data: 'incoming_stock',
                        name: 'incoming_stock',
                        className: 'py-4 px-6',
                        width: '10%',
                    },
                    {
                        data: 'outcoming_stock',
                        name: 'outcoming_stock',
                        className: 'py-4 px-6',
                        width: '10%',
                    },
                ]
            });

            $('#start_date, #end_date').change(function() {
                applyDateFilter();
            });
        });
    </script>
@endpush
