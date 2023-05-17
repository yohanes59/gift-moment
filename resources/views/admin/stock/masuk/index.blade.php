@extends('layouts.app-admin')

@section('title', 'Stok Masuk')

@section('admin')
    <div class="mt-3">
        <div class="text-xl font-medium mb-8">List Stok Masuk</div>

        {{-- Tambah data --}}
        <div class="my-6">
            <x-link to="{{ url('admin/stock/masuk/create') }}" size="md" icon="fa-plus mr-1" text="Tambah Stok Produk"
                padding="py-3 px-5" />
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="py-3 px-6">
                            Tanggal Masuk
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Gambar Produk
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nama Produk
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Jumlah
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Action
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
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'created_at',
                    name: 'created_at',
                    className: 'py-4 px-6 whitespace-nowrap',
                    width: '10%',
                    render: function(data, type, row) {
                        const date = new Date(data);
                        return date.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });
                    }
                },
                {
                    data: 'image',
                    name: 'image',
                    className: 'py-4 px-6',
                    width: '15%'
                },
                {
                    data: 'product.name',
                    name: 'product.name',
                    className: 'py-4 px-6',
                    width: '20%'
                },
                {
                    data: 'incoming_stock',
                    name: 'incoming_stock',
                    className: 'py-4 px-6',
                    width: '10%',
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'py-4 px-6',
                    orderable: false,
                    searchable: false,
                    width: '10%'
                },
            ]
        })

        function deleteData(itemId) {
            let table = $('#crudTable');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = '{{ url('admin/stock/masuk') }}/' + itemId;

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            '_method': 'DELETE',
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function() {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            table.DataTable().ajax.reload()
                        }
                    })
                }
            })
        }
    </script>
@endpush
