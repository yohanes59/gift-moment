@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div>Register</div>
@endsection

{{-- @extends('layouts.app')

@section('title', 'Register')

@section('content')

    <div class="col-md-6">
        <div class="my-3">
            <a href="{{ url('/') }}" class="btn btn-success">
                <i class="fa-solid fa-chevron-left"></i> Kembali
            </a>
        </div>
        <div class="card mx-4">
            <div class="card-body p-4">
                <form action="/register" method="POST">
                    @csrf
                    <h3>Akun Kasir Baru</h3>
                    <hr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}"
                            placeholder="Full Name">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                        </div>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Email">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                        </span>
                        </div>
                        <input name="password" type="password" class="form-control form-control-user @error('password')is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        </div>
                        <input name="password_confirmation" type="password" class="form-control form-control-user @error('password_confirmation')is-invalid @enderror" id="exampleRepeatPassword" placeholder="Repeat Password">
                        @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat mb-3">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection --}}