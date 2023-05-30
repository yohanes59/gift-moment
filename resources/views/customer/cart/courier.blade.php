@extends('layouts.app')

@section('title', 'Pilih Kurir')

@section('content')
    <div class="px-4 lg:px-10 mt-14 mx-auto w-full max-w-screen-xl">
        <div>
            <a href="{{ url('/checkout') }}" class="flex font-semibold text-indigo-600 text-sm mt-10">
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                    <path
                        d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="w-full mt-3 p-4 border border-indigo-100 bg-white shadow-md shadow-indigo-100 rounded-md">
            {{-- <form class="space-y-6" action="{{ route('user.profile', ['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data"> --}}
            <form class="space-y-6" action="" method="POST" enctype="multipart/form-data">
                {{-- @csrf
                @if (isset($data))
                    @method('PUT')
                @endif --}}
                <div>
                    <label for="courier" class="block mb-3 text-sm font-medium text-slate-900">Kurir</label>
                    <select name="courier" class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                        id="courier" required>
                        <option disabled selected>Pilih kurir</option>
                        {{-- @foreach ($category as $data)
                            <option value="{{ $data->id }}"
                                {{ isset($item) ? ($item->courier == $data->id ? 'selected' : '') : '' }}>
                                {{ $data->name }}
                            </option>
                        @endforeach --}}
                        <option value="">JNE</option>
                        <option value="">POS</option>
                        <option value="">TIKI</option>
                    </select>
                    @error('courier')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                    <i class="fa-solid fa-check mr-1"></i>
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection