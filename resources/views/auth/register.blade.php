@extends('layouts.app')

@section('title', 'Register User')

@section('content') 
    <div class="flex justify-center items-center h-screen bg-indigo-100">
        <div class="w-full max-w-md p-8 shadow-lg bg-white rounded-md">
            <h1 class="text-3xl block text-center font-semibold">Register GiftMoment</h1>
            <div class="mt-3 flex justify-center">
                <div class="w-20 h-0.5 bg-slate-800"></div>
            </div>
            <div class="mt-10">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('do.register') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <div class="relative">
                            <input type="text" id="name" name="name" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{ old('name') }}" placeholder=" " />

                            <label for="name" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Nama</label>
                        </div>
                    </div>
                    
                    <div>
                        <div class="relative">
                            <input type="email" id="email" name="email" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{ old('email') }}" placeholder=" " />

                            <label for="email" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Email</label>
                        </div>
                    </div>

                    <div>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />

                            <label for="password" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Password</label>
                        </div>
                    </div>
                    
                    <div>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />

                            <label for="password_confirmation" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Konfirmasi Password</label>
                        </div>
                    </div>

                    <div>
                        <div class="mt-4">
                            <button type="submit" class="py-3 rounded-sm bg-indigo-700 text-white w-full font-semibold">Register</button>
                        </div>
                    </div>

                    <div>
                        <div class="text-sm text-center">
                            <span>Sudah punya akun?</span> <a class="text-indigo-500" href="{{ route('login') }}">Masuk</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection