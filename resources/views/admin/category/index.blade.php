@extends('layouts.app-admin')

@section('title', 'Kategori')

@section('admin')
<div>
    {{-- MODAL DELETE ITEM --}}
    <div id="deleteModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-toggle="deleteModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>

                    {{-- FORM FOR DELETE ITEM --}}
                    <form action="" method="POST">
                        @csrf
                        <input type="text" class="w-full" name="deleted_id" id="delete_id">
                        <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah Anda yakin ingin menghapus kategori ini?</h3>
                        <button data-modal-toggle="deleteModal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
                        <button id="hapus-berita" type="submit" data-modal-toggle="deleteModal"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center ml-2">
                            Yakin
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="text-xl font-medium mb-8">List Kategori</div>

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
        <a href="{{ url('admin/category/create') }}"
            class="py-3 px-5 rounded-md text-white bg-blue-500 hover:bg-blue-600">
            <i class="fa-solid fa-plus mr-1"></i> Tambah Kategori
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto relative shadow-md sm:rounded-md">
        <table class="w-full text-sm text-left text-gray-500">
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
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                <tr class="divide-x">
                    <td class="w-16 py-4 px-6 text-center font-normal text-gray-900 whitespace-nowrap">
                        1
                    </td>
                    <td class="py-4 px-6">
                        Lorem, ipsum.
                    </td>
                    <td class="py-4 px-6">
                        Lorem ipsum
                    </td>
                    <td class="w-32 py-4 px-6">
                        <div class="flex items-center space-x-2">
                            <a href="#" class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                            <a href="{{ url('admin/category/edit') }}" class="py-2 px-3 rounded-md text-white bg-yellow-500 hover:bg-yellow-600">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <button data-modal-toggle="deleteModal" type="button" class="deleteBtn py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600"
                                value="ganti dengan ID item terus edit bagian modal di atas">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteBtn', function(e) {
                e.preventDefault();

                var d_id = $(this).val();
                $('#delete_id').val(d_id);

                $('#deleteModal').modal('show');
            });
        })
    </script>
@endsection