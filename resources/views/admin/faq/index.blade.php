@extends('layouts.app-admin')

@section('title', 'FAQ')

@section('admin')
    <div class="mt-3">
        <div class="text-xl font-medium mb-8">Menu FAQ</div>

        {{-- Tambah data --}}
        <div class="my-6">
            <x-link to="{{ url('admin/faq/create') }}" size="md" icon="fa-plus mr-1" text="Tambah"
                padding="py-3 px-5" />
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