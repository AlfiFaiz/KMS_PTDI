<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\ManajemenInspektor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\Company;


class RegisteredUserController extends Controller
{

    public function create()
    {
        $companies = Company::orderBy('name')->get();

        return view('auth.register', compact('companies'));
    }

    public function store(Request $request)
    {
        /**
         * VALIDASI DASAR (BERLAKU UNTUK SEMUA ROLE)
         */
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:pelanggan,manajemen,inspektor',
            'foto' => 'nullable|image|max:2048',
        ]);



        /**
         * VALIDASI KHUSUS ROLE
         */
        if ($request->role === 'pelanggan') {
            $request->validate([
                'company_id' => 'required|exists:companies,id',
                'position' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'alamat' => 'required|string|max:255',
            ]);
        }

        if (in_array($request->role, ['manajemen', 'inspektor'])) {
            $request->validate([
                'role_detail' => 'required|in:manajemen,inspektor',
                'departemen' => 'required|string|max:255',
                'posisi' => 'required|string|max:255',
                'nomor_pegawai' => 'required|string|max:255',
            ]);
        }



        /**
         * UPLOAD FOTO PROFIL
         */
        $filename = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile_photos', $filename, 'public');
        }

        /**
         * BUAT USER
         */
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role === 'pelanggan'
                ? 'pelanggan'
                : $request->role_detail, // manajemen / inspektor
            'active' => 0,
            'profile_photo' => $filename,
        ]);


        /**
         * SIMPAN DETAIL PELANGGAN
         */
        if ($request->role === 'pelanggan') {
            Pelanggan::create([
                'user_id' => $user->id,
                'company_id' => $request->company_id,
                'position' => $request->position,
                'phone' => $request->phone,
                'alamat' => $request->alamat,
            ]);
        }

        /**
         * SIMPAN DETAIL STAFF (MANAJEMEN / INSPEKTOR)
         */
        if (in_array($request->role, ['manajemen', 'inspektor'])) {
            ManajemenInspektor::create([
                'user_id' => $user->id,
                'role_detail' => $request->role_detail,
                'departemen' => $request->departemen,
                'posisi' => $request->posisi,
                'nomor_pegawai' => $request->nomor_pegawai,
            ]);
        }

        /**
         * EVENT & LOGIN
         */
        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}