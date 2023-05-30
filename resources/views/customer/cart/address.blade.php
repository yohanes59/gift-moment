@extends('layouts.app')

@section('title', 'Edit Alamat')

@section('content')
    <div class="px-4 lg:px-10 mx-auto w-full max-w-screen-xl">
        <div class="lg:ml-5 mt-8">
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
                <form class="space-y-6" action="{{ route('user.profile', ['id' => Auth::user()->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if (isset($data))
                        @method('PUT')
                    @endif
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="space-y-2">
                            <div>
                                <label for="address" class="block mb-3 text-sm font-medium text-slate-900">Alamat</label>
                                <input type="text" name="address" id="address"
                                    class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                    value="{{ isset($data) ? $data->address : '' }}">
                                @error('address')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div>
                                <label for="address_detail" class="block mb-3 text-sm font-medium text-slate-900">Detail Alamat</label>
                                <textarea name="address_detail" id="address_detail" rows="4"
                                    class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5">
                                    {{ isset($data) ? $data->address_detail : '' }}
                                </textarea>
                                @error('address_detail')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div>
                                <label for="phone_number" class="block mb-3 text-sm font-medium text-slate-900">Nomor Telepon</label>
                                <input type="text" name="phone_number" id="phone_number"
                                    class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                    value="{{ isset($data) ? $data->phone_number : '' }}">
                                @error('phone_number')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="space-y-2">
                            <div>
                                <label for="provinces_id" class="block mb-3 text-sm font-medium text-slate-900">Provinsi</label>
                                <select name="provinces_id"
                                    class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                    id="provinces_id" required>
                                    <option disabled selected>Pilih provinsi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province['province_id'] }}"
                                            {{ isset($data) ? ($province['province_id'] == $data->provinces_id ? 'selected' : '') : '' }}>
                                            {{ $province['province'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('provinces_id')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div>
                                <label for="city_id"
                                    class="block mb-3 text-sm font-medium text-slate-900">Kabupaten/Kota</label>
                                <select name="city_id"
                                    class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                    id="city_id" required onchange="updatePostalCode()">
                                    <option disabled selected>Pilih kabupaten/kota</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city['city_id'] }}" data-postal-code="{{ $city['postal_code'] }}"
                                            data-province-id="{{ $city['province_id'] }}"
                                            {{ isset($data) ? ($city['city_id'] == $data->city_id ? 'selected' : '') : '' }}>
                                            {{ $city['city_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div>
                                <label for="postal_code" class="block mb-3 text-sm font-medium text-slate-900">Kode Pos</label>
                                <input type="text" name="postal_code" id="postal_code"
                                    class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                    readonly value="{{ isset($data) ? $data->postal_code : '' }}">
                                @error('postal_code')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
    
                        </div>
                    </div>
    
                    <button type="submit"
                        class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                        <i class="fa-solid fa-check mr-1"></i>
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const destinationSelect = document.getElementById("city_id");
        const destinationProvinceSelect = document.getElementById("provinces_id");

        destinationProvinceSelect.addEventListener("change", () => {
            const selectedProvinceId = destinationProvinceSelect.value;

            // hide all options that don't match the selected province
            Array.from(destinationSelect.options).forEach(option => {
                const cityProvinceId = option.dataset.provinceId;
                option.hidden = (selectedProvinceId !== "" && selectedProvinceId !== cityProvinceId);
            });

            // reset the selected city
            destinationSelect.value = "";
        });

        function updatePostalCode() {
            var select = document.getElementById('city_id');
            var postalCodeInput = document.getElementById("postal_code");
            var selectedOption = select.options[select.selectedIndex];
            postalCodeInput.value = selectedOption.getAttribute("data-postal-code");
        }
    </script>
@endpush
