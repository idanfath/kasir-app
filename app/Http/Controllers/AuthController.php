<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginform()
    {
        if (Auth::check()) {
            return redirect()->intended('/');
        }
        return view('auth.login');
    }


    public function login(Request $request)
    {
        try {
            $v = $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6',
            ]);

            if (Auth::attempt($v)) {
                return redirect()->intended('/')->with('info', 'Login successful');
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('info', 'Logout successful');
    }
}
