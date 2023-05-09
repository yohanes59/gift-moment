@extends('layouts.app-admin')

@section('title', 'Produk')

@section('admin')
    <div>

        <div class="text-xl font-medium mb-8">List Produk</div>

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

        {{-- Tambah data --}}
        <div class="my-6">
            {{-- <a href="{{ url('admin/product/create') }}"
                class="py-3 px-5 rounded-md text-white bg-blue-500 hover:bg-blue-600">
                <i class="fa-solid fa-plus mr-1"></i> Tambah Produk
            </a> --}}
            <x-link to="{{ url('admin/product/create') }}" size="md" icon="fa-plus mr-1" text="Tambah Produk" />
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto relative shadow-md sm:rounded-md">
            <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="w-16 py-3 px-6">
                            ID
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Gambar
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nama
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Kategori
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Harga
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Aksi
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
                    data: 'id',
                    name: 'id',
                    className: 'w-16 py-4 px-6 text-center font-normal text-gray-900 whitespace-nowrap',
                    width: '20%'
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
                    data: 'category.name',
                    name: 'category.name',
                    className: 'py-4 px-6',
                    width: '20%'
                },
                {
                    data: 'price',
                    name: 'price',
                    className: 'py-4 px-6',
                    width: '20%'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
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
                    let url = '{{ url('admin/product') }}/' + itemId;

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
