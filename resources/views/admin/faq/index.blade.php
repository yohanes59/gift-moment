@extends('layouts.app-admin')

@section('title', 'FAQ')

@section('admin')
    <div class="mt-3">
        <div class="text-xl font-medium mb-8">Menu FAQ</div>

        {{-- Tambah data --}}
        <div class="my-6">
            <x-link to="{{ url('admin/faq/create') }}" size="md" icon="fa-plus mr-1" text="Tambah" padding="py-3 px-5" />
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="py-3 px-6">
                            Pertanyaan
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Jawaban
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">

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
                    data: 'question',
                    name: 'question',
                    className: 'py-4 px-6 align-top text-left',
                },
                {
                    data: 'answer',
                    name: 'answer',
                    className: 'py-4 px-6 line-clamp-6',
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'py-4 px-6 align-top text-left',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        })

        $('table').on('draw.dt', function() {
            $('[data-bs-toggle="tooltip-edit"]').tooltip();
            $('[data-bs-toggle="tooltip-delete"]').tooltip();
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
                    let url = '{{ url('admin/faq') }}/' + itemId;

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
