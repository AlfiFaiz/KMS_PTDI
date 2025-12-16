<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Ambil role user
            $role = Auth::user()->role;

            // Redirect sesuai role
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'inspektor':
                    return redirect()->route('inspektor.dashboard');
                case 'manajemen':
                    return redirect()->route('manajemen.dashboard');
                case 'pelanggan':
                default:
                    return redirect()->route('pelanggan.dashboard');
            }
        }

        // Jika gagal login
        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}