@extends('layouts.app')

@section('title', 'Login')

@section('content') 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="flex justify-center items-center h-screen bg-indigo-1000">
        <div class="w-96 p-6 shadow-lg bg-white rounded-md">
            <h1 class="text-3xl block text-center font-semibold"><i class="fa-solid fa-user"></i>Login</h1>
            <hr class="mt-3">
            <div class="mt-3">
                <form action="{{ route('do.login') }}" method="POST">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif    
                @csrf
                <label for="email" class="block text-base mb-2">Email</label>
                <input type="email" id="email" name="email" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" value="{{ old('email') }}" placeholder="Enter Email..."/>
            </div>
            <div class="mt-3">
                <label for="password" class="block text-base mb-2">Password</label>
                <input type="password" id="password" name="password" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Enter Password..."/>
            </div>
            <div class="mt-3 flex justify-between items-center">
            </div>
            <div class="mt-3">
                <button type="submit" class="border-2 border-indigo-700 bg-indigo-700 text-white py-1 w-full hover:text-indigo-700 font-semibold"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;Login</button>
            </div>
            <div class="text-indigo-800 font-semibold mt-3">
                <a class="small" href="{{ route('register') }}">Create an Account!</a>
            </div>
        </form>
        </div>
    </div>
    
</body>
</html>

@endsection