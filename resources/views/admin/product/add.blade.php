@extends('layouts.app-admin')

@section('title', 'Tambah Produk')

@section('admin')
<div>
    <div class="flex gap-3 items-center">
        <a href="{{ url('admin/product') }}" class="py-3 px-5 text-white rounded-xl bg-blue-500 hover:bg-blue-600">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
        <div class="text-lg font-medium">Form Tambah Produk</div>
    </div>

    <div class="max-w-3xl mt-8">
        <form class="space-y-4" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="space-y-2">
                    <div>
                        <label for="nama_produk" class="block mb-3 text-sm font-medium text-slate-900">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" 
                            class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5" 
                            required>
                    </div>
        
                    <div>
                        <label for="harga" class="block mb-3 text-sm font-medium text-slate-900">Harga</label>
                        <input type="number" name="harga" id="harga" 
                            class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5" 
                            required>
                    </div>
                    
                    <div>
                        <label for="deskripsi" class="block mb-3 text-sm font-medium text-slate-900">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-slate-900 bg-slate-50 rounded-md border border-slate-400"></textarea>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <div>
                        <label for="kategori_produk" class="block mb-2 text-sm font-medium text-slate-900">Kategori</label>
                        <select name="kategori_produk" class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5" id="kategori_produk" required>
                            <option disabled selected>Pilih kategori</option>
                            <option>Bucket</option>
                            <option>Souvenir</option>
                            <option>Hantaran</option>
                        </select>
                    </div>

                    <div>
                        <label for="berat" class="block mb-3 text-sm font-medium text-slate-900">Berat produk <span class="text-slate-500">(gram)</span></label>
                        <input type="number" name="berat" id="berat" 
                            class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5" 
                            required>
                    </div>

                    <div><img id="image-preview"></div>
                    <div>                
                        <label class="block mb-2 text-sm font-medium text-slate-900" for="gambar">Upload gambar</label>
                        <input type="file" name="gambar" class="block w-full text-sm text-slate-900 border border-slate-400 rounded-md cursor-pointer bg-slate-50 focus:outline-none"  id="gambar" onchange="previewImage()">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                Tambah
            </button>
        </form>
    </div>
</div>
    
@endsection