@extends('layouts.app-admin')

@section('title', 'Sisa Stok')

@section('admin')
    <div class="mt-3">
        <div class="text-xl font-medium mb-8">List Sisa Stok</div>

        {{-- Table --}}
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="py-3 px-6">
                            ID
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Gambar Produk
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nama Produk
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Jumlah Stok
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y"></tbody>
            </table>
        </div>
    </div>
@endsection

@push('addon-script')
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
                    className: 'w-16 py-4 px-6 text-center font-normal text-gray-900 whitespace-nowrap',
                    width: '20%',
                },
                {
                    data: 'image',
                    name: 'image',
                    className: 'py-4 px-6',
                    width: '20%'
                },
                {
                    data: 'name',
                    name: 'name',
                    className: 'py-4 px-6',
                    width: '20%'
                },
                {
                    data: 'stock_amount',
                    name: 'stock_amount',
                    className: 'py-4 px-6',
                    width: '20%',
                },
            ]
        })
    </script>
@endpush
