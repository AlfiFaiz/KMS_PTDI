@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Knowledge Management')

@section('content')

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                        <i class="fa-solid fa-book-open text-lg"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                        Knowledge Management
                    </h1>
                </div>
                <p class="text-gray-500 text-xs mt-1.5 ml-0.5">
                    Kelola, tinjau, dan organisasi seluruh basis pengetahuan serta dokumentasi internal.
                </p>
            </div>

            <a href="{{ route('knowledge.create') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 
                text-white text-xs font-semibold rounded-xl transition-all shadow-sm shadow-blue-500/10 whitespace-nowrap">
                <i class="fa-solid fa-plus text-[10px]"></i>
                Tambah Knowledge
            </a>
        </div>

        <!-- NOTIFIKASI SUKSES -->
        @if (session('success'))
            <div
                class="mb-6 p-4 bg-emerald-50 border border-emerald-200/60 text-emerald-800 rounded-xl flex items-center gap-3 shadow-sm">
                <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                <span class="text-xs font-medium">{{ session('success') }}</span>
            </div>
        @endif


        {{-- ===================== --}}
        {{-- 🌍 PUBLIC KNOWLEDGE   --}}
        {{-- ===================== --}}
        <div class="mb-10">
            <div class="flex items-center gap-2 mb-4">
                <span class="flex h-2 w-2 rounded-full bg-emerald-500"></span>
                <h2 class="text-xs font-bold uppercase tracking-wider text-gray-400">
                    Public Knowledge Base
                </h2>
            </div>

            <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                <th class="px-6 py-3.5">Judul</th>
                                <th class="px-6 py-3.5">Kategori</th>
                                <th class="px-6 py-3.5">Dibuat Oleh</th>
                                <th class="px-6 py-3.5">Dibuat</th>
                                <th class="px-6 py-3.5">Diperbarui</th>
                                <th class="px-6 py-3.5 text-right pr-8 w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse ($data->where('status','approved') as $item)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td
                                        class="px-6 py-4 font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                                        {{ $item->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200/40">
                                            {{ $item->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-[10px] font-bold uppercase">
                                                {{ substr($item->user->name ?? 'U', 0, 1) }}
                                            </div>
                                            <span
                                                class="text-gray-600 font-medium text-xs">{{ $item->user->name ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 text-xs">
                                        {{ $item->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 text-xs">
                                        {{ $item->updated_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right pr-8">
                                        <div class="flex items-center justify-end gap-1">
                                            <!-- DETAIL -->
                                            <a href="{{ route('knowledge.show', $item->id) }}" title="Lihat Detail"
                                                class="p-2 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                                <i class="fa-solid fa-eye text-sm"></i>
                                            </a>

                                            @if (auth()->user()->role == 'admin' || auth()->id() == $item->created_by)
                                                <!-- EDIT -->
                                                <a href="{{ route('knowledge.edit', $item->id) }}" title="Ubah Data"
                                                    class="p-2 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-colors">
                                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                                </a>

                                                <!-- HAPUS -->
                                                <form action="{{ route('knowledge.destroy', $item->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Hapus data ini?')"
                                                        title="Hapus Data"
                                                        class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-10 text-gray-400 text-xs">
                                        <i class="fa-solid fa-folder-open text-xl mb-2 block text-gray-300"></i>
                                        Tidak ada data public knowledge ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        {{-- ===================== --}}
        {{-- 🔒 PRIVATE / PENDING  --}}
        {{-- ===================== --}}
        @php
            $pendingData = $data->where('status', 'pending')->filter(function ($item) {
                return auth()->user()->role == 'admin' || auth()->id() == $item->created_by;
            });
        @endphp

        @if ($pendingData->count() > 0)
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <h2 class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Private / Pending Review
                    </h2>
                </div>

                <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                    <th class="px-6 py-3.5">Judul</th>
                                    <th class="px-6 py-3.5">Kategori</th>
                                    <th class="px-6 py-3.5">Dibuat Oleh</th>
                                    <th class="px-6 py-3.5">Dibuat</th>
                                    <th class="px-6 py-3.5">Diperbarui</th>
                                    <th class="px-6 py-3.5 text-right pr-8 w-56">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @foreach ($pendingData as $item)
                                    <tr class="hover:bg-gray-50/50 transition-colors group">
                                        <td
                                            class="px-6 py-4 font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                                            {{ $item->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200/40">
                                                {{ $item->category }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-6 h-6 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-[10px] font-bold uppercase">
                                                    {{ substr($item->user->name ?? 'U', 0, 1) }}
                                                </div>
                                                <span
                                                    class="text-gray-600 font-medium text-xs">{{ $item->user->name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 text-xs">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 text-xs">
                                            {{ $item->updated_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-right pr-8">
                                            <div class="flex items-center justify-end gap-1.5">

                                                <!-- APPROVE (TEXT BUTTON KHUSUS ADMIN) -->
                                                @if (auth()->user()->role == 'admin')
                                                    <a href="{{ route('knowledge.approve', $item->id) }}"
                                                        class="px-2.5 py-1.5 mr-1 rounded-md text-xs font-semibold bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white transition-all">
                                                        Approve
                                                    </a>
                                                @endif

                                                <!-- DETAIL -->
                                                <a href="{{ route('knowledge.show', $item->id) }}" title="Lihat Detail"
                                                    class="p-2 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                                    <i class="fa-solid fa-eye text-sm"></i>
                                                </a>

                                                @if (auth()->user()->role == 'admin' || auth()->id() == $item->created_by)
                                                    <!-- EDIT -->
                                                    <a href="{{ route('knowledge.edit', $item->id) }}" title="Ubah Data"
                                                        class="p-2 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-colors">
                                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                                    </a>

                                                    <!-- HAPUS -->
                                                    <form action="{{ route('knowledge.destroy', $item->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Hapus data ini?')"
                                                            title="Hapus Data"
                                                            class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
