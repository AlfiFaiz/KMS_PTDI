@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Manajemen QMS')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                    Manajemen QMS
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola seluruh dokumen Quality Management System secara terstruktur dan terorganisir.
                </p>
            </div>

            @if (auth()->user()->role != 'inspektor')
                <a href="{{ route('qms.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium shadow-sm shadow-blue-500/10 transition-all duration-200 shrink-0">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Tambah Dokumen
                </a>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-gray-200/80 shadow-sm p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="relative md:col-span-2">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" id="search" placeholder="Cari nomor atau judul dokumen..."
                        onkeyup="filterCards()"
                        class="w-full pl-11 pr-4 py-2.5 rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <div class="relative">
                    <select id="filterType" onchange="filterCards()"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all appearance-none">
                        <option value="">Semua Tipe</option>
                        <option value="manual">MANUAL</option>
                        <option value="quality document">QUALITY DOCUMENT</option>
                        <option value="procedure">PROCEDURE</option>
                        <option value="work instruction">WORK INSTRUCTION</option>
                        <option value="form">FORM</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div
                class="flex items-center gap-3 p-4 mb-6 rounded-xl border border-green-200 bg-green-50 text-green-700 shadow-sm">
                <i class="fa-solid fa-circle-check text-lg text-green-500"></i>
                <div class="text-sm font-medium">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div id="qmsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($qms as $q)
                <div class="qms-card bg-white rounded-xl border border-gray-200/80 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 overflow-hidden flex flex-col"
                    data-nomor="{{ strtolower($q->nomor) }}" data-judul="{{ strtolower($q->judul) }}"
                    data-type="{{ strtolower($q->type) }}">

                    <div class="p-5 border-b border-gray-100 bg-gray-50/30">
                        <div class="flex items-start justify-between gap-3">
                            <div class="space-y-1">
                                <span
                                    class="inline-flex items-center text-[10px] font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2 py-0.5 rounded">
                                    {{ $q->type }}
                                </span>
                                <h2 class="text-base font-semibold text-gray-900 leading-snug line-clamp-2">
                                    {{ $q->judul }}
                                </h2>
                            </div>
                            <div
                                class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 text-gray-500">
                                <i class="fa-solid fa-file-shield text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 space-y-3.5 flex-1 text-sm">
                        <div class="flex gap-3 items-start">
                            <div class="w-5 h-5 flex items-center justify-center shrink-0 text-gray-400 mt-0.5">
                                <i class="fa-solid fa-hashtag text-xs"></i>
                            </div>
                            <div class="space-y-0.5 w-full">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Nomor Dokumen</p>
                                <p class="text-gray-700 font-medium break-all">{{ $q->nomor }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-1">
                            <div class="flex gap-2 items-start">
                                <div class="w-4 h-4 flex items-center justify-center shrink-0 text-gray-400 mt-0.5">
                                    <i class="fa-solid fa-calendar-day text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Issued</p>
                                    <p class="text-gray-600 text-xs font-medium">{{ $q->date_issued }}</p>
                                </div>
                            </div>

                            <div class="flex gap-2 items-start">
                                <div class="w-4 h-4 flex items-center justify-center shrink-0 text-gray-400 mt-0.5">
                                    <i class="fa-solid fa-code-branch text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Revision</p>
                                    <span
                                        class="inline-block mt-0.5 text-[11px] font-bold text-blue-700 bg-blue-50/80 px-1.5 py-0.2 rounded">
                                        REV {{ $q->rev }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3 items-start border-t border-gray-100 pt-3">
                            <div class="w-5 h-5 flex items-center justify-center shrink-0 text-gray-400">
                                <i class="fa-solid fa-clock text-xs"></i>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <span class="text-[11px] font-medium text-gray-400">Dibuat pada</span>
                                <span
                                    class="text-xs text-gray-600 font-medium">{{ $q->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50 mt-auto">
                        @if (auth()->user()->role == 'inspektor')
                            <div
                                class="w-full py-1.5 rounded-lg bg-gray-100 text-gray-500 text-center font-medium text-xs flex items-center justify-center gap-1.5">
                                <i class="fa-solid fa-eye text-[11px]"></i>
                                View Only
                            </div>
                        @else
                            <div class="flex gap-2">
                                <a href="{{ route('qms.edit', $q->id) }}"
                                    class="flex-1 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-semibold text-center transition-colors flex items-center justify-center gap-1">
                                    <i class="fa-solid fa-pen text-[10px]"></i>
                                    Edit
                                </a>

                                <form action="{{ route('qms.destroy', $q->id) }}" method="POST" class="flex-1"
                                    onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="w-full py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold transition-colors flex items-center justify-center gap-1">
                                        <i class="fa-solid fa-trash text-[10px]"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
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
                <h2 class="text-lg font-bold text-gray-800">Dokumen tidak ditemukan</h2>
                <p class="text-sm text-gray-500 mt-1">Coba gunakan kata kunci lain atau ubah filter tipe dokumen.</p>
            </div>
        </div>

        <div class="mt-6">
            {{ $qms->links() }}
        </div>

    </div>

    <script>
        function filterCards() {
            let search = document.getElementById("search").value.toLowerCase();
            let filterType = document.getElementById("filterType").value.toLowerCase();
            let cards = document.querySelectorAll(".qms-card");
            let visible = 0;

            cards.forEach(card => {
                let nomor = card.dataset.nomor;
                let judul = card.dataset.judul;
                let type = card.dataset.type;

                let matchesSearch = nomor.includes(search) || judul.includes(search);
                let matchesFilter = filterType === "" || type === filterType;

                if (matchesSearch && matchesFilter) {
                    card.style.display = "flex";
                    visible++;
                } else {
                    card.style.display = "none";
                }
            });

            document.getElementById("emptyState").style.display = visible === 0 ? "block" : "none";
        }
    </script>
@endsection
