@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div>Beranda</div>
    <a href="{{ route('login') }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Login</a>
@endsection