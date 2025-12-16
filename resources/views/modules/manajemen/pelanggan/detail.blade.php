@extends('layouts.manajemen')

@section('content')
    <div class="p-6">

        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('pelanggan.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
            <h1 class="text-2xl font-bold text-blue-700">Detail Akun</h1>
        </div>

        <!-- Card Utama -->
        <div class="bg-white shadow-lg rounded-xl p-6 flex gap-6">

            <!-- Foto Profil -->
            <div>
                @if ($user->profile_photo)
                    <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}"
                        class="w-32 h-32 rounded-full object-cover border shadow">
                @else
                    <img src="{{ asset('images/default-user.png') }}"
                        class="w-32 h-32 rounded-full object-cover border shadow">
                @endif
            </div>

            <!-- Info Dasar -->
            <div class="flex-1">
                <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>

                <div class="mt-3">
                    <span
                        class="px-3 py-1 rounded-full text-white text-sm
                    @if ($user->role == 'admin') bg-red-600
                    @elseif($user->role == 'manajemen') bg-blue-600
                    @elseif($user->role == 'inspektor') bg-yellow-600
                    @else bg-green-600 @endif">
                        {{ ucfirst($user->role) }}
                    </span>

                    <span
                        class="px-3 py-1 rounded-full text-white text-sm ml-2
                    @if ($user->active) bg-green-600 @else bg-red-600 @endif">
                        {{ $user->active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
                <div class="mt-4">
                    <form action="{{ route('users.toggleActive', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        @if ($user->active)
                            <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                Nonaktifkan User
                            </button>
                        @else
                            <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                Aktifkan User
                            </button>
                        @endif
                    </form>
                </div>

            </div>

        </div>

        <!-- Detail Berdasarkan Role -->
        <div class="mt-8 bg-white shadow-md rounded-xl p-6">

            <h3 class="text-xl font-bold text-blue-700 mb-4">Informasi Detail</h3>

            @if ($user->role == 'pelanggan')
                @include('modules.manajemen.pelanggan.detail.pelanggan')
            @elseif($user->role == 'admin')
                @include('modules.manajemen.pelanggan.detail.admin')
            @elseif($user->role == 'manajemen' || $user->role == 'inspektor')
                @include('modules.manajemen.pelanggan.detail.manajemen_inspektor')
            @else
                <p class="text-gray-500">Tidak ada detail tambahan.</p>
            @endif

        </div>

    </div>
@endsection
