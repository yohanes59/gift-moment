<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        $user = User::get();

        return view('auth.register',['users' => $user]);
    }

    public function doRegister(AuthRegisterRequest $request)
	{
		User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'roles' => 'User'
		]);

		return redirect('/login')->withSuccess('Registrasi Akun Berhasil!');
	}

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(AuthLoginRequest $request)
    {
            if (!Auth::attempt($request->only('email', 'password'))) {
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed')
                ]);
            }

        $request->session()->regenerate();

        if (Auth::user()->name == 'admin') {
			return redirect('admin/dashboard');
		} else {
			return redirect('/');
		}
    }

    public function logout(Request $request)
	{
		Auth::guard('web')->logout();

		$request->session()->invalidate();

		return redirect('/');
	}
}
