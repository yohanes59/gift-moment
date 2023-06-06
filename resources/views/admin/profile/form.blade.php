@extends('layouts.app-admin')

@section('title', 'Edit Profile')

@section('admin')
    <div class="lg:ml-5 mt-3">
        <div class="flex gap-3 items-center">
            <x-link to="{{ url('admin/dashboard') }}" size="lg" icon="fa-chevron-left mr-1" text="Kembali"
                padding="py-2 px-4" color="blue" />
            <div class="text-lg font-medium">Form {{ 'Edit Profile' }}</div>
        </div>

        <div class="max-w-4xl mt-3 p-4 bg-white shadow-md rounded-md">
            <form class="space-y-2" action="{{ route('admin.profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($item))
                    @method('PUT')
                @endif
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="space-y-2">
                        <div>
                            <label for="address" class="block mb-3 text-sm font-medium text-slate-900">Alamat</label>
                            <input type="text" name="address" id="address"
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                value="{{ isset($item) ? $item->address : '' }}">
                            @error('address')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="address_detail" class="block mb-3 text-sm font-medium text-slate-900">Detail
                                Alamat</label>
                            <input type="text" name="address_detail" id="address_detail"
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                value="{{ isset($item) ? $item->address_detail : '' }}">
                            @error('address_detail')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone_number" class="block mb-3 text-sm font-medium text-slate-900">Nomor
                                Telepon</label>
                            <input type="text" name="phone_number" id="phone_number"
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                value="{{ isset($item) ? $item->phone_number : '' }}">
                            @error('phone_number')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="account_number" class="block mb-3 text-sm font-medium text-slate-900">Nomor
                                Rekening</label>
                            <input type="text" name="account_number" id="account_number"
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                value="{{ isset($item) ? $item->account_number : '' }}">
                            @error('account_number')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div>
                            <label for="provinces_id" class="block mb-3 text-sm font-medium text-slate-900">Provinsi</label>
                            <select name="provinces_id"
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                id="provinces_id" required>
                                <option disabled selected>Pilih provinsi</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province['province_id'] }}"
                                        {{ isset($item) ? ($province['province_id'] == $item->provinces_id ? 'selected' : '') : '' }}>
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
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                id="city_id" required onchange="updatePostalCode()">
                                <option disabled selected>Pilih kabupaten/kota</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city['city_id'] }}" data-postal-code="{{ $city['postal_code'] }}"
                                        data-province-id="{{ $city['province_id'] }}"
                                        {{ isset($item) ? ($city['city_id'] == $item->city_id ? 'selected' : '') : '' }}>
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
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                readonly value="{{ isset($item) ? $item->postal_code : '' }}">
                            @error('postal_code')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <button type="submit"
                    class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const originSelect = document.getElementById("city_id");
        const originProvinceSelect = document.getElementById("provinces_id");

        originProvinceSelect.addEventListener("change", () => {
            const selectedProvinceId = originProvinceSelect.value;

            // hide all options that don't match the selected province
            Array.from(originSelect.options).forEach(option => {
                const cityProvinceId = option.dataset.provinceId;
                option.hidden = (selectedProvinceId !== "" && selectedProvinceId !== cityProvinceId);
            });

            // reset the selected city
            originSelect.value = "";
        });

        function updatePostalCode() {
            var select = document.getElementById('city_id');
            var postalCodeInput = document.getElementById("postal_code");
            var selectedOption = select.options[select.selectedIndex];
            postalCodeInput.value = selectedOption.getAttribute("data-postal-code");
        }
    </script>
@endpush
