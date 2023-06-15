@extends('layouts.app-admin')

@section('title', isset($item) ? 'Edit Kategori' : 'Tambah Kategori')

@section('admin')
    <div class="lg:ml-5 mt-3">
        <div class="flex gap-3 items-center">
            <x-link to="{{ url('admin/category') }}" size="lg" icon="fa-chevron-left mr-1" text="Kembali" padding="py-2 px-4"
                color="blue" />
            <div class="text-lg font-medium">Form {{ isset($item) ? 'Edit Kategori' : 'Tambah Kategori' }}</div>
        </div>

        <div class="max-w-xl mt-3 p-4 bg-white shadow-md rounded-md">
            <form class="space-y-2"
                action="{{ isset($item) ? url('/admin/category/' . $item->id) : url('/admin/category') }}" method="POST"
                enctype="multipart/form-data">
                @if (isset($item))
                    @method('PUT')
                @endif
                @csrf
                <div>
                    <label for="name" class="block mb-3 text-sm font-medium text-slate-900">Nama Kategori</label>
                    <input type="text" name="name" id="name"
                        class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                        value="{{ isset($item) ? $item->name : '' }}">
                    @error('name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    @if (isset($item) && $item->image)
                        <img id="image-preview" src="{{ Storage::url($item->image) }}">
                    @else
                        <img id="image-preview">
                    @endif
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-900" for="image">Upload gambar</label>
                    <input type="file" name="image"
                        class="block w-full text-sm text-slate-900 border border-slate-400 rounded-md cursor-pointer bg-slate-100 focus:outline-none"
                        id="image" onchange="previewImage()">
                    @error('image')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                    {{ isset($item) ? 'Edit' : 'Tambah' }}
                </button>
            </form>
        </div>
    </div>

@endsection
