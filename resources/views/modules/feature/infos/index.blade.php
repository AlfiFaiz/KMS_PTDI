@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Manajemen Info')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-6">

        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 via-indigo-950 to-blue-900 p-8 shadow-sm">
            <div
                class="absolute top-0 right-0 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl translate-x-20 -translate-y-20">
            </div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/10 text-blue-200 text-xs font-medium mb-3.5 tracking-wider uppercase">
                        <i class="fa-solid fa-newspaper text-[11px]"></i>
                        Information Management
                    </div>

                    <h1 class="text-2xl md:text-3xl font-bold text-white tracking-tight">
                        Manajemen Informasi
                    </h1>

                    <p class="text-blue-100/80 mt-2 text-sm max-w-2xl leading-relaxed">
                        Kelola seluruh informasi perusahaan, pengumuman, berita internal, dan dokumentasi penting dengan
                        mudah dalam satu panel terpusat.
                    </p>
                </div>

                @if (auth()->user()->role != 'inspektor')
                    <a href="{{ route('infos.create') }}"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white hover:bg-gray-50 text-slate-900 text-sm font-semibold shadow-sm transition-all shrink-0">
                        <i class="fa-solid fa-plus text-xs text-blue-600"></i>
                        Tambah Info
                    </a>
                @endif
            </div>
        </div>

        <div class="bg-white border border-gray-200/80 rounded-xl shadow-sm p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                <div class="relative md:col-span-2">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" id="search"
                        class="w-full h-11 pl-11 pr-4 rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                        placeholder="Cari judul atau konten info..." onkeyup="filterCards()">
                </div>

                <div>
                    <select id="filterImage"
                        class="w-full h-11 px-3.5 rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                        onchange="filterCards()">
                        <option value="">Semua Info</option>
                        <option value="ada">Dengan Gambar</option>
                        <option value="tidak">Tanpa Gambar</option>
                    </select>
                </div>

            </div>
        </div>

        @if (session('success'))
            <div
                class="flex items-center gap-3 p-4 rounded-xl border border-green-200 bg-green-50 text-green-700 shadow-sm">
                <i class="fa-solid fa-circle-check text-lg text-green-500"></i>
                <div class="text-sm font-medium">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div id="infoContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($infos as $info)
                <div class="info-card bg-white rounded-xl border border-gray-200/80 overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex flex-col"
                    data-title="{{ strtolower($info->title) }}" data-content="{{ strtolower(strip_tags($info->content)) }}"
                    data-image="{{ $info->image_path ? 'ada' : 'tidak' }}">

                    <div
                        class="relative h-48 overflow-hidden bg-gray-50 border-b border-gray-100 shrink-0 flex items-center justify-center">
                        @if ($info->image_path)
                            <img src="{{ asset('storage/' . $info->image_path) }}"
                                class="w-full h-full object-cover transition duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent">
                            </div>

                            <div class="absolute bottom-3 left-3.5">
                                <span
                                    class="px-2.5 py-1 rounded-md bg-black/40 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-wider border border-white/10">
                                    <i class="fa-solid fa-image mr-1"></i> Gambar
                                </span>
                            </div>
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center bg-blue-50/50 text-blue-500">
                                <div
                                    class="w-14 h-14 rounded-xl bg-white border border-blue-100 flex items-center justify-center shadow-sm mb-2">
                                    <i class="fa-solid fa-newspaper text-xl"></i>
                                </div>
                                <span class="text-[10px] font-bold text-blue-400 uppercase tracking-wider">Teks
                                    Pengumuman</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <h2 class="text-base font-semibold text-gray-900 leading-snug line-clamp-2">
                                {{ $info->title }}
                            </h2>
                            <p class="mt-2 text-xs text-gray-500 leading-relaxed line-clamp-3">
                                {!! Str::limit(strip_tags($info->content), 120) !!}
                            </p>
                        </div>

                        <div class="space-y-1.5 text-xs border-t border-gray-100 pt-3 text-gray-500">
                            <div class="flex items-center justify-between">
                                <span>Diterbitkan:</span>
                                <span class="font-medium text-gray-700">{{ $info->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Perubahan:</span>
                                <span class="font-medium text-gray-700">{{ $info->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="flex gap-2 pt-1">
                            <a href="#"
                                class="flex-1 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-semibold text-center transition-colors flex items-center justify-center gap-1.5">
                                <i class="fa-solid fa-eye text-[11px]"></i>
                                Lihat
                            </a>

                            @if (auth()->user()->role != 'inspektor')
                                <a href="{{ route('infos.edit', $info->id) }}"
                                    class="px-3 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-semibold text-center transition-colors flex items-center justify-center">
                                    <i class="fa-solid fa-pen text-[11px]"></i>
                                </a>

                                <form action="{{ route('infos.destroy', $info->id) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Hapus info ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold flex items-center justify-center transition-colors">
                                        <i class="fa-solid fa-trash text-[11px]"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <div id="emptyState" class="hidden">
            <div class="bg-white border border-dashed border-gray-200 rounded-xl p-12 text-center shadow-sm">
                <div
                    class="w-16 h-16 mx-auto rounded-full bg-gray-50 flex items-center justify-center text-2xl text-gray-400 mb-4">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h2 class="text-base font-bold text-gray-800">Data informasi tidak ditemukan</h2>
                <p class="text-xs text-gray-500 mt-1">Coba gunakan kata kunci lain atau ubah pengaturan saringan filter
                    Anda.</p>
            </div>
        </div>

        <div class="mt-4">
            {{ $infos->links() }}
        </div>

    </div>

    <script>
        function filterCards() {
            let search = document.getElementById("search").value.toLowerCase();
            let filterImage = document.getElementById("filterImage").value;
            let cards = document.querySelectorAll(".info-card");
            let visible = 0;

            cards.forEach(card => {
                let title = card.dataset.title;
                let content = card.dataset.content;
                let image = card.dataset.image;

                let matchesSearch = title.includes(search) || content.includes(search);
                let matchesFilter = filterImage === "" || image === filterImage;

                if (matchesSearch && matchesFilter) {
                    card.style.display =
                    "flex"; // Tetap menggunakan flex untuk menjaga konsistensi susunan tinggi kartu
                    visible++;
                } else {
                    card.style.display = "none";
                }
            });

            document.getElementById("emptyState").style.display = visible === 0 ? "block" : "none";
        }
    </script>
@endsection
