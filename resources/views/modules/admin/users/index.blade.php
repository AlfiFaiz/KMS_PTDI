@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')

<br>
<div class="bg-gray-50 shadow-md rounded-lg p-6">


    <!-- Header + Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-xl font-bold text-blue-700">Daftar User</h2>

        <form method="GET" action="" class="mt-4 md:mt-0">
            <input type="text" name="search" placeholder="Cari user..."
                   class="border border-gray-300 rounded-lg px-4 py-2 w-64 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </form>
    </div>

    <!-- Dashboard Role -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <a href="{{ route('users.index') }}">
    <div class="p-5 rounded-xl shadow-lg bg-gradient-to-br from-gray-500 to-gray-300 text-white transform hover:scale-105 transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Semua User</h3>
                <p class="text-4xl font-extrabold mt-2">{{ $countAll }}</p>
            </div>
            <i class="fa-solid fa-users-gear text-4xl opacity-80"></i>
        </div>
    </div>
</a>

    <!-- Admin -->    
    <a href="{{ route('users.index', ['role' => 'admin']) }}">
    <div class="p-5 rounded-xl shadow-lg bg-gradient-to-br from-blue-700 to-blue-500 text-white transform hover:scale-105 transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Admin</h3>
                <p class="text-4xl font-extrabold mt-2">{{ $countAdmin }}</p>
            </div>
            <i class="fa-solid fa-user-shield text-4xl opacity-80"></i>
        </div>
    </div>
    </a>

    <!-- Manajemen -->
    <a href="{{ route('users.index', ['role' => 'manajemen']) }}">
        
        <div class="p-5 rounded-xl shadow-lg bg-gradient-to-br from-blue-600 to-blue-400 text-white transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Manajemen</h3>
                    <p class="text-4xl font-extrabold mt-2">{{ $countManajemen }}</p>
                </div>
                <i class="fa-solid fa-briefcase text-4xl opacity-80"></i>
            </div>
        </div>
    </a>

    <!-- Inspektor -->
    <a href="{{ route('users.index', ['role' => 'inspektor']) }}">
        
        <div class="p-5 rounded-xl shadow-lg bg-gradient-to-br from-blue-500 to-blue-300 text-white transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Inspektor</h3>
                    <p class="text-4xl font-extrabold mt-2">{{ $countInspektor }}</p>
                </div>
                <i class="fa-solid fa-user-tie text-4xl opacity-80"></i>
            </div>
        </div>
    </a>

    <!-- Pelanggan -->
   <a href="{{ route('users.index', ['role' => 'pelanggan']) }}">
    <div class="p-5 rounded-xl shadow-lg bg-gradient-to-br from-blue-400 to-blue-200 text-white transform hover:scale-105 transition duration-300 cursor-pointer">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Pelanggan</h3>
                <p class="text-4xl font-extrabold mt-2">{{ $countPelanggan }}</p>
            </div>
            <i class="fa-solid fa-users text-4xl opacity-80"></i>
        </div>
    </div>
</a>

</div>
<div class="overflow-x-auto">
    <table class="min-w-full bg-gray-50 border border-gray-200 rounded-lg">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="py-3 px-4 text-left">#</th>
            <th class="py-3 px-4 text-left">Foto</th>
            <th class="py-3 px-4 text-left">Nama</th>
            <th class="py-3 px-4 text-left">Email</th>
            <th class="py-3 px-4 text-left">Role</th>
            <th class="py-3 px-4 text-left">Status</th>
            <th class="py-3 px-4 text-left">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr class="border-b hover:bg-gray-100">
            <td class="py-3 px-4">{{ $loop->iteration }}</td>
            <td class="py-3 px-4">
    @if($user->profile_photo)
        <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}"
             class="w-12 h-12 rounded-full object-cover border">
    @else
        <img src="{{ asset('images/default-user.png') }}"
             class="w-12 h-12 rounded-full object-cover border">
    @endif
</td>

            <td class="py-3 px-4">{{ $user->name }}</td>
            <td class="py-3 px-4">{{ $user->email }}</td>
            <td class="py-3 px-4 capitalize">{{ $user->role }}</td>

            <!-- Status -->
            <td class="py-3 px-4">
                @if($user->active)
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                        Aktif
                    </span>
                @else
                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-semibold">
                        Tidak Aktif
                    </span>
                @endif
            </td>

            <!-- Aksi -->
            <td class="py-3 px-4 flex space-x-2">

                <!-- Toggle Active -->
                <form action="{{ route('users.toggleActive', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if($user->active)
                        <button type="submit"
                            class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition">
                            Nonaktifkan
                        </button>
                    @else
                        <button type="submit"
                            class="bg-green-600 text-white px-3 py-1 rounded-md hover:bg-green-700 transition">
                            Aktifkan
                        </button>
                    @endif
                </form>

                <!-- Edit -->
                <a href="{{ route('users.detail', $user->id) }}"
                   class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>

                <!-- Delete -->
                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>

</div>

@endsection