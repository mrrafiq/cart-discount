<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function post_login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect('/');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        Session::flash('error', 'Invalid login credentials');
        return redirect()->back()->with('error', 'Invalid login credentials');
        
    }

    public function post_register(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'name' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required|same:password'
            ]);
            if (!$validated) {
                Session::flash('error', 'Pastikan form diisi dengan benar');
                return redirect()->back()->withInput();
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->assignRole('customer');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect('/auth/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/auth/login');
    }
}
