@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div>Login</div>
@endsection

{{-- @extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="d-flex flex-row vh-100 justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <form action="/login" method="POST">
                        @csrf
                        <h1>Silahkan Login</h1>
                        <hr>
                        
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
                        <button type="submit" class="btn btn-primary btn-block btn-flat mb-3">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection --}}