@extends('layouts.app-admin')

@section('title', 'Edit Kategori')

@section('admin')
<div>
    <div class="flex gap-3 items-center">
        <a href="{{ url('admin/category') }}" class="py-3 px-5 text-white rounded-xl bg-blue-500 hover:bg-blue-600">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
        <div class="text-lg font-medium">Form Edit Kategori</div>
    </div>

    <div class="max-w-xl mt-8">
        <form class="space-y-2" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="category_name" class="block mb-3 text-sm font-medium text-slate-900">Nama Kategori</label>
                <input type="text" name="category_name" id="category_name" 
                    class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5" 
                    required
                    value="Lorem ipsum">
            </div>

            <div><img id="image-preview"></div>
            <div>                
                <label class="block mb-2 text-sm font-medium text-slate-900" for="gambar">Upload gambar</label>
                <input type="file" name="gambar" class="block w-full text-sm text-slate-900 border border-slate-400 rounded-md cursor-pointer bg-slate-50 focus:outline-none" id="gambar" onchange="previewImage()">
            </div>
            
            <button type="submit" class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                Tambah
            </button>
        </form>
    </div>
</div>
    
@endsection