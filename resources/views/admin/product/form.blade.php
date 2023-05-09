@extends('layouts.app-admin')

@section('title', isset($item) ? 'Edit Produk' : 'Tambah Produk')

@section('admin')
    <div>
        <div class="flex gap-3 items-center">
            {{-- <a href="{{ url('admin/category') }}" class="py-3 px-5 text-white rounded-xl bg-blue-500 hover:bg-blue-600">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </a> --}}
            <x-link to="{{ url('admin/product') }}" size="xl" icon="fa-arrow-left mr-1" text="Kembali" padding="py-3 px-5"
                color="blue" />
            <div class="text-lg font-medium">Form {{ isset($item) ? 'Edit Produk' : 'Tambah Produk' }}</div>
        </div>

        <div class="max-w-xl mt-8">
            <form class="space-y-2" action="{{ isset($item) ? url('/admin/product/' . $item->id) : url('/admin/product') }}"
                method="POST" enctype="multipart/form-data">
                @if (isset($item))
                    @method('PUT')
                @endif
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="space-y-2">
                        <div>
                            <label for="name" class="block mb-3 text-sm font-medium text-slate-900">Nama</label>
                            <input type="text" name="name" id="name"
                                class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                value="{{ isset($item) ? $item->name : '' }}">
                            @error('name')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block mb-3 text-sm font-medium text-slate-900">Harga</label>
                            <input type="number" name="price" id="price"
                                class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                value="{{ isset($item) ? $item->price : '' }}">
                            @error('price')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block mb-3 text-sm font-medium text-slate-900">Deskripsi</label>
                            <textarea id="description" name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-slate-900 bg-slate-50 rounded-md border border-slate-400">{{ isset($item) ? $item->description : '' }}</textarea>
                            @error('description')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div>
                            <label for="categories_id"
                                class="block mb-3 text-sm font-medium text-slate-900">Kategori</label>
                            <select name="categories_id"
                                class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                id="categories_id" required>
                                <option disabled selected>Pilih kategori</option>
                                @foreach ($category as $data)
                                    <option value="{{ $data->id }}" {{ isset($item) ? ($item->categories_id == $data->id ? 'selected' : '') : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories_id')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="weight" class="block mb-3 text-sm font-medium text-slate-900">Berat
                                (Gram)</label>
                            <input type="number" name="weight" id="weight"
                                class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                value="{{ isset($item) ? $item->weight : '' }}">
                            @error('weight')
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
                            <label class="block mb-2 text-sm font-medium text-slate-900" for="image">Upload
                                gambar</label>
                            <input type="file" name="image"
                                class="block w-full text-sm text-slate-900 border border-slate-400 rounded-md cursor-pointer bg-slate-50 focus:outline-none"
                                id="image" onchange="previewImage()">
                            @error('image')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                    {{ isset($item) ? 'Edit' : 'Tambah' }}
                </button>
            </form>
        </div>
    </div>

@endsection