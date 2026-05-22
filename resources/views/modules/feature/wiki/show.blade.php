@extends('layouts.' . auth()->user()->role)

@section('page-title', $wiki->title)

@section('content')

    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="flex items-center justify-between pb-4 border-b border-gray-200/60">
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <a href="{{ route('wiki.index') }}" class="hover:text-blue-600 transition-colors">Wiki Articles</a>
                <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                <span class="text-gray-800 font-medium">Detail</span>
            </div>

            <a href="{{ route('wiki.index') }}"
                class="inline-flex items-center gap-2 text-xs font-semibold text-gray-600 hover:text-blue-600 bg-white border border-gray-200 px-3 py-1.5 rounded-lg shadow-sm hover:shadow transition-all">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="grid lg:grid-cols-4 gap-6 items-start">

            <div class="lg:col-span-3 space-y-6">

                <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-6">
                        <div class="space-y-2 max-w-2xl">
                            <h1 class="text-2xl font-bold text-gray-900 tracking-tight leading-tight">
                                {{ $wiki->title }}
                            </h1>
                        </div>

                        <div class="shrink-0">
                            @if ($wiki->status == 'published')
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/50">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Published
                                </span>
                            @elseif ($wiki->status == 'review')
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200/50">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending Review
                                </span>
                            @elseif ($wiki->status == 'draft')
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gray-50 text-gray-600 border border-gray-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span> Draft
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200/50">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span> Archived
                                </span>
                            @endif
                        </div>
                    </div>

                    <article
                        class="prose prose-sm sm:prose max-w-none text-gray-700 leading-relaxed mb-8 prose-headings:font-bold prose-a:text-blue-600">
                        {!! $wiki->content !!}
                    </article>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-5 border-t border-gray-100">
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Kategori</span>
                            <span
                                class="inline-block mt-1 text-xs font-medium px-2 py-0.5 bg-gray-100 border border-gray-200/60 text-gray-700 rounded-md">
                                {{ $wiki->category ?? 'General' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Estimasi
                                Baca</span>
                            <span class="text-xs font-semibold text-gray-700 block mt-1"><i
                                    class="fa-regular fa-clock text-gray-400 mr-1"></i>{{ $readingTime }} min read</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Tanggal
                                Rilis</span>
                            <span
                                class="text-xs font-medium text-gray-500 block mt-1">{{ $wiki->created_at->format('d M Y') }}</span>
                        </div>
                        <div>
                            <span
                                class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Pembaruan</span>
                            <span
                                class="text-xs font-medium text-gray-500 block mt-1">{{ $wiki->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white border border-gray-200/80 rounded-2xl shadow-sm p-4 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <form method="POST" action="{{ route('wiki.helpful', $wiki) }}">
                            @csrf
                            <button
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-200/40 text-emerald-700 transition text-xs font-semibold">
                                <i class="fa-regular fa-thumbs-up"></i> Helpful ({{ $wiki->helpfuls->count() }})
                            </button>
                        </form>

                        <form method="POST" action="{{ route('wiki.bookmark', $wiki) }}">
                            @csrf
                            <button
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 border border-blue-200/40 text-blue-700 transition text-xs font-semibold">
                                <i class="fa-regular fa-bookmark"></i> Bookmark ({{ $wiki->bookmarks->count() }})
                            </button>
                        </form>
                    </div>

                    @if (auth()->user()->role !== 'pelanggan')
                        <div class="flex items-center gap-2">
                            <a href="{{ route('wiki.edit', $wiki) }}"
                                class="px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">
                                <i class="fa-regular fa-pen-to-square mr-1"></i> Edit Wiki
                            </a>

                            @if (auth()->user()->role === 'inspektor' && $wiki->status === 'draft')
                                <form method="POST" action="{{ route('wiki.review', $wiki) }}">
                                    @csrf
                                    <button
                                        class="px-3 py-1.5 bg-amber-500 text-white text-xs font-semibold rounded-lg hover:bg-amber-600 transition shadow-sm">
                                        <i class="fa-regular fa-paper-plane mr-1"></i> Send Review
                                    </button>
                                </form>
                            @endif

                            @if (in_array(auth()->user()->role, ['admin', 'manajemen']))
                                @if ($wiki->status === 'review')
                                    <form method="POST" action="{{ route('wiki.publish', $wiki) }}">
                                        @csrf
                                        <button
                                            class="px-3 py-1.5 bg-emerald-600 text-white text-xs font-semibold rounded-lg hover:bg-emerald-700 transition shadow-sm">
                                            <i class="fa-solid fa-check mr-1"></i> Publish
                                        </button>
                                    </form>
                                @endif

                                @if ($wiki->status === 'published')
                                    <form method="POST" action="{{ route('wiki.archive', $wiki) }}">
                                        @csrf
                                        <button
                                            class="px-3 py-1.5 bg-gray-700 text-white text-xs font-semibold rounded-lg hover:bg-gray-800 transition shadow-sm">
                                            <i class="fa-solid fa-box-archive mr-1"></i> Archive
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>

                <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm p-6 sm:p-8">
                    <div class="flex items-center justify-between mb-6 pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-comments text-gray-400 text-base"></i>
                            <h3 class="text-base font-bold text-gray-900 tracking-tight">Kolom Diskusi Internal</h3>
                        </div>
                        <span class="text-xs text-gray-400 font-medium">{{ $wiki->comments->count() }} komentar</span>
                    </div>

                    @if (auth()->check())
                        <form action="{{ route('wiki.comments.store', $wiki) }}" method="POST" class="space-y-3 mb-8">
                            @csrf
                            <div class="relative">
                                <textarea name="comment" rows="3" required
                                    class="w-full border border-gray-300 rounded-xl p-4 text-sm text-gray-800 placeholder:text-gray-400 bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                                    placeholder="Tulis tanggapan atau feedback diskusi Anda disini..."></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-sm transition-all">
                                    Post Komentar
                                </button>
                            </div>
                        </form>
                    @endif

                    <div class="space-y-4">
                        @forelse($wiki->comments as $comment)
                            <div
                                class="p-4 border border-gray-100 rounded-xl bg-gray-50/40 hover:bg-gray-50 transition-colors flex gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100/80 text-blue-700 font-bold text-xs uppercase flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($comment->user->name ?? 'S', 0, 1)) }}
                                </div>

                                <div class="flex-1 space-y-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span
                                                class="text-xs font-bold text-gray-900 block sm:inline-block mr-1.5">{{ $comment->user->name ?? 'System' }}</span>
                                            <span
                                                class="text-[10px] text-gray-400 font-medium">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 text-xs sm:text-sm leading-relaxed">
                                        {!! nl2br(e($comment->comment)) !!}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 bg-gray-50/30 border border-dashed border-gray-200 rounded-xl">
                                <i class="fa-regular fa-message text-xl mb-1.5 block text-gray-300"></i>
                                <p class="text-xs text-gray-400">Belum ada diskusi aktif. Jadilah yang pertama berkomentar.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-history text-gray-400 text-sm"></i>
                            <h3 class="text-sm font-bold text-gray-900 tracking-tight">Version History</h3>
                        </div>
                        <span class="text-xs text-gray-400 font-medium">{{ $wiki->versions->count() }} versi</span>
                    </div>

                    <div class="space-y-2.5 max-h-[320px] overflow-y-auto pr-1">
                        @forelse($wiki->versions as $version)
                            <a href="{{ route('wiki.version.show', [$wiki, $version]) }}"
                                class="flex items-center justify-between p-3 rounded-xl border border-gray-100 bg-gray-50/30 hover:bg-gray-50 hover:border-gray-200 transition-all group">
                                <div class="space-y-0.5">
                                    <p class="text-xs font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                                        Revision Update</p>
                                    <p class="text-[10px] text-gray-400"><i
                                            class="fa-regular fa-calendar text-[9px] mr-1"></i>{{ $version->edited_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                                <div class="text-right space-y-0.5">
                                    <p class="text-xs font-semibold text-gray-600">
                                        {{ $version->editor->name ?? 'System' }}</p>
                                    <p
                                        class="text-[10px] font-medium text-blue-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                        Bandingkan →</p>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-6 text-xs text-gray-400">Belum ada riwayat perubahan versi.</div>
                        @endforelse
                    </div>
                </div>

            </div>

            <div class="space-y-6 lg:sticky lg:top-6">

                <div
                    class="bg-white border border-gray-200/80 rounded-2xl shadow-sm p-5 flex items-center justify-around text-center divide-x divide-gray-100">
                    <div class="flex-1">
                        <span class="block text-xl font-bold text-gray-900 tracking-tight">{{ $wiki->views }}</span>
                        <span class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Views</span>
                    </div>
                    <div class="flex-1">
                        <span
                            class="block text-xl font-bold text-gray-900 tracking-tight">{{ $wiki->helpfuls->count() }}</span>
                        <span class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Helpful</span>
                    </div>
                </div>

                <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm p-5">
                    <h3
                        class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3 pb-2 border-b border-gray-50 flex items-center gap-1.5">
                        <i class="fa-solid fa-tags text-gray-400 text-[11px]"></i> Tags / Label
                    </h3>
                    <div class="flex flex-wrap gap-1.5">
                        @php $hasTags = false; @endphp
                        @foreach (explode(',', $wiki->tags ?? '') as $tag)
                            @if (trim($tag))
                                @php $hasTags = true; @endphp
                                <span
                                    class="px-2.5 py-1 bg-gray-50 text-gray-600 border border-gray-200/60 text-[11px] font-medium rounded-md hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200/60 transition-colors cursor-default">
                                    #{{ trim($tag) }}
                                </span>
                            @endif
                        @endforeach
                        @if (!$hasTags)
                            <span class="text-xs text-gray-400 italic">Tidak ada tag.</span>
                        @endif
                    </div>
                </div>

                <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm p-5">
                    <h3
                        class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3 pb-2 border-b border-gray-50 flex items-center gap-1.5">
                        <i class="fa-regular fa-lightbulb text-gray-400 text-[11px]"></i> Artikel Terkait
                    </h3>
                    <div class="space-y-2.5">
                        @forelse($relatedWikis as $related)
                            <a href="{{ route('wiki.show', $related) }}"
                                class="block p-2.5 rounded-xl border border-gray-100 bg-gray-50/20 hover:bg-gray-50/80 transition-all group">
                                <p
                                    class="text-xs font-semibold text-gray-700 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    {{ $related->title }}
                                </p>
                                <p class="text-[10px] text-gray-400 mt-1">
                                    {{ $related->updated_at->diffForHumans() }}
                                </p>
                            </a>
                        @empty
                            <p class="text-xs text-gray-400 italic">Tidak ada artikel terkait.</p>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
