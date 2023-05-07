@extends('layouts.app-admin')

@section('title', 'Tambah Kategori')

@section('admin')
    <div>
        <div class="flex gap-3 items-center">
            <a href="{{ url('admin/category') }}" class="py-3 px-5 text-white rounded-xl bg-blue-500 hover:bg-blue-600">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </a>
            <div class="text-lg font-medium">Form {{ isset($item) ? 'Edit Kategori' : 'Tambah Kategori' }}</div>
        </div>

        <div class="max-w-xl mt-8">
            <form class="space-y-2" action="{{ isset($item) ? url('/admin/category/' . $item->id) : url('/admin/category') }}"
                method="POST" enctype="multipart/form-data">
                @if (isset($item))
                    @method('PUT')
                @endif
                @csrf
                <div>
                    <label for="name" class="block mb-3 text-sm font-medium text-slate-900">Nama Kategori</label>
                    <input type="text" name="name" id="name"
                        class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
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
                        class="block w-full text-sm text-slate-900 border border-slate-400 rounded-md cursor-pointer bg-slate-50 focus:outline-none"
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
