@extends('layouts.app')

@section('title', 'Edit Profil')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-14 md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div class="px-4 lg:px-10 mx-auto w-full max-w-screen-xl">
        <!-- Breadcrumb -->
        <div class="pt-10">
            <nav class="flex px-5 py-3 text-slate-700 border border-indigo-200 rounded-lg bg-white shadow-md shadow-indigo-100"
                aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-indigo-600">
                            <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2">Akun</span>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2">Edit Profil</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mt-8">
            <div class="w-full p-4 bg-white border border-indigo-200 shadow-md shadow-indigo-100 rounded-md">
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
                                <label for="address_detail" class="block mb-3 text-sm font-medium text-slate-900">Detail
                                    Alamat</label>
                                <textarea name="address_detail" id="address_detail" rows="4"
                                    class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5">
                                    {{ isset($data) ? $data->address_detail : '' }}
                                </textarea>
                                @error('address_detail')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="phone_number" class="block mb-3 text-sm font-medium text-slate-900">Nomor
                                    Telepon</label>
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
                                <label for="provinces_id"
                                    class="block mb-3 text-sm font-medium text-slate-900">Provinsi</label>
                                <select name="provinces_id"
                                    class="bg-slate-50 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                    id="provinces_id" required>
                                    <option disabled selected value="0">Pilih provinsi</option>
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
                                        <option value="{{ $city['city_id'] }}"
                                            data-postal-code="{{ $city['postal_code'] }}"
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
                                <label for="postal_code" class="block mb-3 text-sm font-medium text-slate-900">Kode
                                    Pos</label>
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
        const provincesSelect = document.getElementById("provinces_id");
        const citiesSelect = document.getElementById("city_id");

        function hideCities() {
            Array.from(citiesSelect.options).forEach(option => {
                option.hidden = true;
            });
        }

        hideCities(); // hide cities on page load

        provincesSelect.addEventListener("change", () => {
            const selectedProvinceId = provincesSelect.value;

            if (selectedProvinceId === "") {
                hideCities(); // hide cities if no province is selected
            } else {
                // show options that match the selected province
                Array.from(citiesSelect.options).forEach(option => {
                    const cityProvinceId = option.dataset.provinceId;
                    option.hidden = (selectedProvinceId !== cityProvinceId);
                });

                // reset the selected city if it's not in the new options
                if (!Array.from(citiesSelect.options).some(option => !option.hidden && option.value === citiesSelect
                        .value)) {
                    citiesSelect.value = "";
                }
            }
        });

        function updatePostalCode() {
            var select = document.getElementById('city_id');
            var postalCodeInput = document.getElementById("postal_code");
            var selectedOption = select.options[select.selectedIndex];
            postalCodeInput.value = selectedOption.getAttribute("data-postal-code");
        }
    </script>
@endpush
