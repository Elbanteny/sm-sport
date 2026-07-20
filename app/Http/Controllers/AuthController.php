<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() { 
        return view('auth.login'); 
    }
    
    public function showRegister() { 
        return view('auth.register'); 
    }
    
    public function showAdminLogin() { 
        return view('admin.login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20', 
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone_number, 
            'password' => Hash::make($request->password),
            'role' => 'customer', 
        ]);

        return redirect()->route('login')->with('success', 'Registrasi sukses! Silakan login.');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required', 
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard'); 
            }

            Auth::logout();
            return back()->withErrors(['username' => 'Akses ditolak. Anda bukan Administrator.'])->withInput();
        }

        return back()->withErrors(['username' => 'Kredensial keamanan tidak cocok.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}