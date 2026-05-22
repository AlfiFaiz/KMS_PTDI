@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Manajemen Sertifikat')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                    Daftar Sertifikat
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    @if (auth()->user()->role == 'inspektor')
                        Pratinjau data sertifikat perusahaan dengan tampilan modern.
                    @else
                        Kelola seluruh berkas dan masa berlaku sertifikat perusahaan Anda.
                    @endif
                </p>
            </div>

            @if (auth()->user()->role != 'inspektor')
                <a href="{{ route('certificates.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium shadow-sm shadow-blue-500/10 transition-all duration-200 shrink-0">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Tambah Sertifikat
                </a>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-gray-200/80 shadow-sm p-4 mb-6">
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" id="search" placeholder="Cari nomor, judul sertifikat, atau penerbit..."
                    onkeyup="filterCertificates()"
                    class="w-full pl-11 pr-4 py-2.5 rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
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

        <div id="certificateGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($certificates as $c)
                <div
                    class="certificate-card bg-white rounded-xl border border-gray-200/80 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 overflow-hidden flex flex-col">

                    <div
                        class="relative h-48 bg-gray-50 border-b border-gray-100 overflow-hidden shrink-0 flex items-center justify-center">
                        @php
                            $extension = pathinfo($c->file_path, PATHINFO_EXTENSION);
                        @endphp

                        {{-- IMAGE --}}
                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'webp']))
                            <img src="{{ asset('storage/certificates/' . $c->file_path) }}"
                                class="w-full h-full object-cover transition duration-300">
                            {{-- PDF --}}
                        @elseif(strtolower($extension) == 'pdf')
                            <div
                                class="w-full h-full flex flex-col items-center justify-center bg-red-50 text-red-600 transition-colors">
                                <i class="fa-solid fa-file-pdf text-5xl opacity-80 mb-2"></i>
                                <span class="text-xs font-semibold uppercase tracking-wider">Dokumen PDF</span>
                            </div>
                            {{-- FILE LAIN --}}
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50 text-gray-400">
                                <i class="fa-solid fa-file-invoice text-5xl mb-2"></i>
                                <span class="text-xs font-semibold uppercase tracking-wider">Berkas Sertifikat</span>
                            </div>
                        @endif

                        <div class="absolute top-3.5 right-3.5">
                            @if (auth()->user()->role == 'inspektor')
                                <span
                                    class="px-2.5 py-1 bg-gray-900/80 backdrop-blur text-white text-[10px] font-bold uppercase tracking-wider rounded-md shadow-sm">
                                    View Only
                                </span>
                            @else
                                <span
                                    class="px-2.5 py-1 bg-emerald-600/90 backdrop-blur text-white text-[10px] font-bold uppercase tracking-wider rounded-md shadow-sm">
                                    Active
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">
                                {{ $c->nomor }}
                            </p>
                            <h2 class="text-base font-semibold text-gray-900 leading-snug line-clamp-2">
                                {{ $c->judul }}
                            </h2>

                            <div class="mt-4 space-y-2 text-sm border-t border-gray-100 pt-3">
                                <div class="flex items-center gap-2.5 text-gray-600">
                                    <div
                                        class="w-5 h-5 rounded bg-gray-100 flex items-center justify-center text-gray-400 shrink-0">
                                        <i class="fa-solid fa-calendar text-xs"></i>
                                    </div>
                                    <span class="text-xs font-medium">
                                        {{ \Carbon\Carbon::parse($c->date_issued)->format('d M Y') }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2.5 text-gray-600">
                                    <div
                                        class="w-5 h-5 rounded bg-gray-100 flex items-center justify-center text-gray-400 shrink-0">
                                        <i class="fa-solid fa-building text-xs"></i>
                                    </div>
                                    <span class="text-xs font-medium truncate">
                                        {{ $c->issued_by }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-t border-gray-100 flex gap-2">
                            <a href="{{ asset('storage/certificates/' . $c->file_path) }}" target="_blank"
                                class="flex-1 py-1.5 rounded-lg text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors
                                @if (auth()->user()->role == 'inspektor') bg-blue-600 hover:bg-blue-700 text-white
                                @else bg-blue-50 hover:bg-blue-100 text-blue-700 @endif">
                                <i class="fa-solid fa-eye text-[11px]"></i>
                                {{ auth()->user()->role == 'inspektor' ? 'Lihat Berkas' : 'Buka Berkas' }}
                            </a>

                            {{-- ACTIONS ADMIN / MANAGEMENT --}}
                            @if (auth()->user()->role != 'inspektor')
                                <a href="{{ route('certificates.edit', $c->id) }}"
                                    class="px-3 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-semibold transition-colors flex items-center justify-center">
                                    <i class="fa-solid fa-pen text-[11px]"></i>
                                </a>

                                <form action="{{ route('certificates.destroy', $c->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus sertifikat ini?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold transition-colors flex items-center justify-center">
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
                    <i class="fa-solid fa-award"></i>
                </div>
                <h2 class="text-lg font-bold text-gray-800">Sertifikat tidak ditemukan</h2>
                <p class="text-sm text-gray-500 mt-1">Coba masukkan nomor sertifikat atau instansi penerbit lainnya.</p>
            </div>
        </div>

        <div class="mt-6">
            {{ $certificates->links() }}
        </div>

    </div>

    <script>
        function filterCertificates() {
            let search = document.getElementById("search").value.toLowerCase();
            let cards = document.querySelectorAll(".certificate-card");
            let visible = 0;

            cards.forEach(card => {
                let text = card.innerText.toLowerCase();
                if (text.includes(search)) {
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
