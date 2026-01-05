@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="p-4 space-y-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <h2 class="text-lg font-bold text-blue-700">Daftar User</h2>

        <form method="GET" action="" class="mt-3 md:mt-0">
            <div class="relative">
                <input type="text" name="search" placeholder="Cari user..."
                       class="border border-gray-300 rounded-md px-3 py-1.5 text-sm w-full md:w-64 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <button type="submit" class="absolute right-2 top-2 text-gray-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
    @php
        $roles = [
            // Menggunakan kode warna HEX yang pekat agar teks putih terlihat tajam
            ['label' => 'Semua User', 'count' => $countAll, 'param' => [], 'color' => '#334155', 'icon' => 'fa-users-gear'], // Slate 700
            ['label' => 'Admin', 'count' => $countAdmin, 'param' => ['role' => 'admin'], 'color' => '#1e40af', 'icon' => 'fa-user-shield'], // Blue 800
            ['label' => 'Manajemen', 'count' => $countManajemen, 'param' => ['role' => 'manajemen'], 'color' => '#2563eb', 'icon' => 'fa-briefcase'], // Blue 600
            ['label' => 'Inspektor', 'count' => $countInspektor, 'param' => ['role' => 'inspektor'], 'color' => '#4f46e5', 'icon' => 'fa-indigo-600'], // Indigo 600
            ['label' => 'Pelanggan', 'count' => $countPelanggan, 'param' => ['role' => 'pelanggan'], 'color' => '#0891b2', 'icon' => 'fa-users'], // Cyan 600
        ];
    @endphp

    @foreach($roles as $r)
    <a href="{{ route('users.index', $r['param']) }}" class="transform hover:scale-102 transition duration-200">
        <div class="p-3 rounded-lg shadow-sm text-white" style="background-color: {{ $r['color'] }};">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-[10px] font-bold uppercase tracking-wider text-white" style="color: white !important;">{{ $r['label'] }}</h3>
                    <p class="text-xl font-black mt-0.5 text-white" style="color: white !important;">{{ $r['count'] }}</p>
                </div>
                <i class="fa-solid {{ $r['icon'] }} text-lg text-white opacity-40"></i>
            </div>
        </div>
    </a>
    @endforeach
</div>

    <div class="bg-white shadow-md rounded-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-xs text-left border-collapse">
                <thead class="bg-blue-600 text-white uppercase font-bold text-[11px]">
                    <tr>
                        <th class="py-3 px-4 w-10 text-center">#</th>
                        <th class="py-3 px-4">User</th>
                        <th class="py-3 px-4 text-center">Role</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-center text-gray-500 font-medium">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div style="width: 40px; height: 40px;" class="mr-3 flex-shrink-0">
                                    <img src="{{ $user->profile_photo ? asset('storage/profile_photos/' . $user->profile_photo) : asset('images/default-user.png') }}"
                                         style="width: 40px; height: 40px; min-width: 40px;"
                                         class="rounded-full object-cover border border-gray-200">
                                </div>
                                <div class="overflow-hidden">
                                    <div class="font-bold text-gray-800 text-sm truncate">{{ $user->name }}</div>
                                    <div class="text-[10px] text-gray-500 truncate">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-[10px] font-bold uppercase border border-gray-300">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($user->active)
                                <span class="inline-flex items-center px-2 py-0.5 bg-green-100 text-green-700 rounded font-bold border border-green-200">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 bg-red-100 text-red-700 rounded font-bold border border-red-200">
                                    Off
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <form action="{{ route('users.toggleActive', $user->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="p-2 rounded border {{ $user->active ? 'bg-amber-50 text-amber-600 border-amber-200' : 'bg-green-50 text-green-600 border-green-200' }} hover:shadow-sm" title="Ubah Status">
                                        <i class="fa-solid {{ $user->active ? 'fa-toggle-on' : 'fa-toggle-off' }} text-lg"></i>
                                    </button>
                                </form>

                                <a href="{{ route('users.detail', $user->id) }}" 
                                   class="p-2 bg-blue-50 text-blue-600 border border-blue-200 rounded hover:shadow-sm" title="Edit User">
                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 border border-red-200 rounded hover:shadow-sm" title="Hapus User">
                                        <i class="fa-solid fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 flex justify-between items-center text-[11px] text-gray-500 font-medium">
        <span>Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} User</span>
        <div class="scale-90 origin-right">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection