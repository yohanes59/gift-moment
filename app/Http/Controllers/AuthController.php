<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        $user = User::get();

        return view('auth.register',['users' => $user]);
    }

    public function doRegister(Request $request)
	{
		Validator::make($request->all(), [
			'name' => 'required|string',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed'
		])->validate();

		User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'roles' => 'User'
		]);

		return redirect('/login')->with('alert', 'Sucsess create account');
	}

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        Validator::make(
            $request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed')
                ]);
            }

        $request->session()->regenerate();

        return redirect('/admin/dashboard');
    }

    public function editUserAccount()
    {

    }

    public function logout(Request $request)
	{
		Auth::guard('web')->logout();

		$request->session()->invalidate();

		return redirect('/login');
	}
}
