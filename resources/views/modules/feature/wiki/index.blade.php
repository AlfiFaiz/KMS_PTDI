@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Wiki Knowledge')

@section('content')

    <div class="p-6 space-y-6">

        <!-- HERO (Kembali ke Ukuran Awal) -->
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-2xl p-8 text-white shadow-lg">

            <h1 class="text-3xl font-bold mb-2">
                Knowledge Wiki
            </h1>

            <p class="text-blue-100 mb-6">
                Temukan dokumentasi, prosedur, troubleshooting,
                dan knowledge internal perusahaan.
            </p>

            <!-- SEARCH -->
            <form method="GET">

                <div class="flex flex-col md:flex-row gap-3">

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search knowledge..."
                        class="flex-1 px-5 py-3 rounded-xl text-gray-800 focus:outline-none">

                    <select name="category" class="px-4 py-3 rounded-xl text-gray-700 focus:outline-none">

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>

                                {{ $category }}

                            </option>
                        @endforeach

                    </select>

                    <button class="bg-white text-blue-700 font-semibold px-6 py-3 rounded-xl hover:bg-blue-50 transition">

                        Search

                    </button>

                </div>

            </form>

        </div>

        <!-- QUICK STATS (Kembali ke Ukuran Awal) -->
        <div class="grid md:grid-cols-3 gap-4">

            <div class="bg-white p-5 rounded-xl border shadow-sm">

                <p class="text-sm text-gray-500">
                    Total Articles
                </p>

                <h2 class="text-3xl font-bold text-blue-700 mt-1">
                    {{ $wikis->total() }}
                </h2>

            </div>

            <div class="bg-white p-5 rounded-xl border shadow-sm">

                <p class="text-sm text-gray-500">
                    Categories
                </p>

                <h2 class="text-3xl font-bold text-blue-700 mt-1">
                    {{ $categories->count() }}
                </h2>

            </div>

            <div class="bg-white p-5 rounded-xl border shadow-sm">

                <p class="text-sm text-gray-500">
                    Knowledge Views
                </p>

                <h2 class="text-3xl font-bold text-blue-700 mt-1">
                    {{ \App\Models\Wiki::sum('views') }}
                </h2>

            </div>

        </div>

        <!-- CONTENT MASTER GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">

            <!-- SIDEBAR COLUMN (Diubah Menjadi Mode Kolos Berdampingan / Hemat Ruang Vertikal) -->
            <div class="lg:col-span-1 flex flex-col gap-6">

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                    <!-- HEADER UTAMA SIDEBAR -->
                    <div
                        class="px-4 py-3 border-b bg-gradient-to-r from-blue-600 to-cyan-500 text-white flex items-center gap-2">
                        <i class="fa-solid fa-star text-xs"></i>
                        <h3 class="font-bold text-sm">
                            Aktivitas & Informasi
                        </h3>
                    </div>

                    <!-- GRID INTERNAL: Membagi Terbaru & Populer Menjadi Kolom Kiri-Kanan -->
                    <div class="p-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">

                        <!-- BARU DIPERBARUI -->
                        <div class="space-y-2">
                            <h4
                                class="text-[11px] font-bold text-gray-400 uppercase tracking-wider border-b pb-1 flex items-center gap-1.5">
                                <i class="fa-solid fa-clock-rotate-left text-blue-600"></i> Recently Updated
                            </h4>
                            <div class="space-y-2 max-h-[250px] overflow-y-auto pr-1">
                                @foreach ($recentWikis as $recent)
                                    <a href="{{ route('wiki.show', $recent) }}"
                                        class="group block rounded-xl border border-gray-50 p-2.5 hover:border-blue-200 hover:bg-blue-50/40 transition-all">
                                        <p
                                            class="text-xs font-semibold text-gray-700 line-clamp-1 group-hover:text-blue-700 transition">
                                            {{ $recent->title }}
                                        </p>
                                        <div class="flex items-center gap-1 mt-0.5 text-[10px] text-gray-400">
                                            <i class="fa-regular fa-clock"></i>
                                            <span>{{ $recent->updated_at->diffForHumans() }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- ARTIKEL TERPOPULER -->
                        <div class="space-y-2">
                            <h4
                                class="text-[11px] font-bold text-gray-400 uppercase tracking-wider border-b pb-1 flex items-center gap-1.5">
                                <i class="fa-solid fa-fire text-orange-500"></i> Popular Articles
                            </h4>
                            <div class="space-y-2 max-h-[250px] overflow-y-auto pr-1">
                                @foreach ($popularWikis as $popular)
                                    <a href="{{ route('wiki.show', $popular) }}"
                                        class="group block rounded-xl border border-gray-50 p-2.5 hover:border-orange-200 hover:bg-orange-50/40 transition-all">
                                        <p
                                            class="text-xs font-semibold text-gray-700 line-clamp-1 group-hover:text-orange-700 transition">
                                            {{ $popular->title }}
                                        </p>
                                        <div class="flex items-center gap-1 mt-0.5 text-[10px] text-orange-500">
                                            <i class="fa-solid fa-eye text-[9px]"></i>
                                            <span>{{ $popular->views }} views</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- ARTICLE GRID COLUMN -->
            <div class="lg:col-span-3">

                <div class="flex justify-between items-center mb-4">

                    <h2 class="text-xl font-bold text-gray-800">
                        Knowledge Articles
                    </h2>

                    @if (auth()->user()->role !== 'pelanggan')
                        <a href="{{ route('wiki.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm">
                            + Create Wiki
                        </a>
                    @endif

                </div>

                <!-- CARD CONTAINER GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                    @forelse($wikis as $wiki)

                        <a href="{{ route('wiki.show', $wiki) }}"
                            class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition overflow-hidden group flex flex-col justify-between">

                            <!-- TOP CONTENT -->
                            <div class="p-5">

                                <!-- CATEGORY & STATUS -->
                                <div class="flex justify-between items-center mb-3">

                                    <span
                                        class="text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-700">
                                        {{ $wiki->category ?? 'General' }}
                                    </span>

                                    <span
                                        class="text-[10px] font-medium px-2 py-0.5 rounded-full
                                        {{ $wiki->status == 'published' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $wiki->status == 'review' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $wiki->status == 'draft' ? 'bg-gray-100 text-gray-700' : '' }}
                                        {{ $wiki->status == 'archived' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($wiki->status) }}
                                    </span>

                                </div>

                                <!-- TITLE -->
                                <h3
                                    class="text-sm font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-700 transition">
                                    {{ $wiki->title }}
                                </h3>

                                <!-- EXCERPT -->
                                <p class="text-xs text-gray-500 line-clamp-3 leading-relaxed">
                                    {{ Str::limit(strip_tags($wiki->content), 120) }}
                                </p>

                            </div>

                            <!-- FOOTER AREA -->
                            <div class="px-5 py-3 border-t bg-gray-50/70 mt-auto">

                                <!-- TAGS -->
                                @if ($wiki->tags)
                                    <div class="flex flex-wrap gap-1.5 mb-2">
                                        @foreach (explode(',', $wiki->tags) as $tag)
                                            @if (trim($tag))
                                                <span
                                                    class="text-[10px] bg-gray-200/80 text-gray-600 px-2 py-0.5 rounded-md font-medium">
                                                    #{{ trim($tag) }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                <!-- META -->
                                <div class="flex justify-between items-center text-[11px] text-gray-400">

                                    <span class="inline-flex items-center gap-1">
                                        <i class="fa-regular fa-calendar text-[10px]"></i>
                                        {{ $wiki->updated_at->diffForHumans() }}
                                    </span>

                                    <span class="font-medium text-gray-500">
                                        👁 {{ $wiki->views }}
                                    </span>

                                </div>

                            </div>

                        </a>

                    @empty

                        <div class="col-span-full bg-white border rounded-2xl p-12 text-center text-gray-400">
                            <i class="fa-solid fa-book text-4xl mb-3 text-gray-300"></i>
                            <p class="text-sm">Tidak ada knowledge ditemukan.</p>
                        </div>

                    @endforelse

                </div>

                <!-- PAGINATION -->
                <div class="mt-6">
                    {{ $wikis->withQueryString()->links() }}
                </div>

            </div>

        </div>

    </div>

@endsection
