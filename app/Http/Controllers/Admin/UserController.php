<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $role = $request->role;

        $users = User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })
            ->when($role, function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->paginate(10);

        // Hitung role
        $countAdmin = User::where('role', 'admin')->count();
        $countManajemen = User::where('role', 'manajemen')->count();
        $countInspektor = User::where('role', 'inspektor')->count();
        $countPelanggan = User::where('role', 'pelanggan')->count();
        $countAll = User::count();

        return view('modules.admin.users.index', compact(
            'users',
            'countAdmin',
            'countManajemen',
            'countInspektor',
            'countPelanggan',
            'countAll'
        ));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('modules.admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();

        return back()->with('success', 'Status user berhasil diperbarui.');
    }
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,manajemen,inspektor,pelanggan',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role user berhasil diperbarui.');
    }
    public function detail($id)
    {
        $user = User::with([
            'pelanggan',
            'admin',
            'manajemenInspektor'
        ])->findOrFail($id);

        return view('modules.admin.users.detail', compact('user'));
    }



}