@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Global Search')

@section('content')

    @php
        function highlight($text, $keyword)
        {
            if (!$keyword) {
                return e($text);
            }

            return preg_replace(
                '/' . preg_quote($keyword, '/') . '/i',
                '<mark class="bg-yellow-100 text-yellow-800 font-semibold px-1 rounded-sm shadow-sm">$0</mark>',
                e($text),
            );
        }
    @endphp

    <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                Pencarian Global
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Cari data berdasarkan kata kunci judul, isi konten, maupun kategori spesifik di seluruh sistem.
            </p>
        </div>

        <div class="bg-white border border-gray-200/80 rounded-xl shadow-sm p-4">
            <form action="{{ route('global.search') }}" method="GET" class="flex gap-3">

                <div class="relative flex-1">
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan judul, kata kunci konten, atau nama kategori..." required
                        autocomplete="off"
                        class="w-full h-10 pl-9 pr-4 rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <button type="submit"
                    class="h-10 px-6 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm shadow-blue-500/10 transition-colors flex items-center justify-center gap-2 shrink-0">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    Cari Data
                </button>
            </form>
        </div>

        @if (request('search'))
            <div class="text-sm text-gray-500 pl-1">
                Menampilkan hasil pencarian untuk kata kunci: <span
                    class="font-bold text-gray-800">"{{ request('search') }}"</span>
            </div>
        @endif

        <div class="space-y-3.5">
            @forelse($results as $result)
                <a href="{{ $result['url'] }}"
                    class="block bg-white rounded-xl border border-gray-200/90 p-4 shadow-sm hover:shadow-md hover:border-blue-300 hover:bg-blue-50/[0.01] transition-all duration-200 group">

                    <div class="flex items-start gap-4">
                        <div
                            class="w-11 h-11 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center text-xl shrink-0 group-hover:bg-blue-50/50 group-hover:border-blue-100 transition-colors">
                            {{ $result['icon'] }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-gray-100 text-gray-600 border border-gray-200 shadow-sm">
                                    {{ $result['type'] }}
                                </span>

                                @if (!empty($result['category']))
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-100 shadow-sm">
                                        <i class="fa-solid fa-tag text-[9px] mr-1 opacity-70"></i>
                                        {!! highlight($result['category'], request('search')) !!}
                                    </span>
                                @endif
                            </div>

                            <h2
                                class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors truncate">
                                {!! highlight($result['title'], request('search')) !!}
                            </h2>

                            <p class="text-xs text-gray-500 mt-1 leading-relaxed line-clamp-2">
                                {!! highlight($result['description'], request('search')) !!}
                            </p>
                        </div>

                        <div class="self-center text-gray-300 group-hover:text-blue-500 pl-2 transition-colors">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </div>
                    </div>

                </a>
            @empty
                <div class="bg-white rounded-xl border border-dashed border-gray-300 p-12 text-center shadow-sm">
                    <div
                        class="w-14 h-14 mx-auto rounded-full bg-gray-50 flex items-center justify-center text-gray-400 text-xl mb-3.5">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h3 class="text-base font-bold text-gray-800">
                        {{ request('search') ? 'Data tidak ditemukan' : 'Mulai Pencarian' }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-1.5 max-w-sm mx-auto leading-relaxed">
                        {{ request('search') ? 'Gunakan kata kunci atau nama kategori alternatif lainnya untuk memetakan pencarian sistem.' : 'Masukkan teks klausa, nama kategori, nomor sertifikat, judul berkas atau materi berita pada panel di atas.' }}
                    </p>
                </div>
            @endforelse
        </div>

    </div>
@endsection
