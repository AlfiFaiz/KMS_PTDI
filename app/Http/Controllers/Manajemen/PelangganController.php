<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        // Query hanya pelanggan
        $users = User::where('role', 'pelanggan')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                });
            })
            ->paginate(10);

        // Hitung hanya pelanggan
        $countPelanggan = User::where('role', 'pelanggan')->count();

        return view('modules.manajemen.pelanggan.index', compact(
            'users',
            'countPelanggan'
        ));
    }


    public function create()
    {
        return view('modules.manajemen.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'pelanggan', // fix role pelanggan
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pelanggan = User::where('role', 'pelanggan')->findOrFail($id);
        return view('modules.manajemen.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $pelanggan = User::where('role', 'pelanggan')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pelanggan->id,
        ]);

        $pelanggan->update($request->only('name', 'email'));

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pelanggan = User::where('role', 'pelanggan')->findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();

        return back()->with('success', 'Status user berhasil diperbarui.');
    }
    public function detail($id)
    {
        $user = User::with([
            'pelanggan',
            'admin',
            'manajemenInspektor'
        ])->findOrFail($id);

        return view('modules.manajemen.pelanggan.detail', compact('user'));
    }
}