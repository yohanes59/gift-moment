@extends('layouts.app-admin')

@section('title', 'Customer')

@section('admin')
    <div class="mt-3">

        <div class="text-xl font-medium mb-8">List Customer</div>

        {{-- Table --}}
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500" id="crudTable">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="w-16 py-3 px-6">
                            No
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nama
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Alamat
                        </th>
                        <th scope="col" class="py-3 px-6">
                            No. Telp
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($data as $item)
                        <tr class="divide-x divide-y">
                            <td scope="col" class="w-16 py-3 px-6">
                                {{ $loop->iteration }}
                            </td>
                            <td scope="col" class="w-16 py-3 px-6">
                                {{ $item->user->name }}
                            </td>
                            <td scope="col" class="w-16 py-3 px-6">
                                {{ $item->address }}, {{ $item->address_detail }},
                                @foreach ($userDetails as $detail)
                                    @if ($detail['users_id'] == $item->users_id)
                                        {{ $detail['cityName'] }} - {{ $detail['provinceName'] }}
                                    @endif
                                @endforeach
                            </td>
                            <td scope="col" class="w-16 py-3 px-6">
                                {{ $item->phone_number }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
@endsection
