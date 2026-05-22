@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Version Comparison')

@section('content')
    <div class="bg-gray-50/50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                    <div>
                        <p class="text-sm text-blue-600 font-semibold mb-1">
                            Wiki Version Comparison
                        </p>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            {{ $wiki->title }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Compare article revisions and identify changes between versions.
                        </p>
                    </div>

                    <div>
                        <a href="{{ route('wiki.show', $wiki) }}"
                            class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-800 text-white rounded-xl text-sm font-semibold shadow-sm hover:bg-black transition-all duration-200">
                            ← Back to Article
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-lg font-bold text-red-600">Previous Version</h2>
                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs rounded-full font-semibold">OLD</span>
                    </div>

                    @if ($oldVersion)
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Edited By</p>
                                <p class="font-semibold text-gray-700 mt-0.5">{{ $oldVersion->editor->name ?? 'System' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Edited At</p>
                                <p class="font-semibold text-gray-700 mt-0.5">
                                    {{ $oldVersion->edited_at->format('d M Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Status</p>
                                <p class="font-semibold text-gray-700 mt-0.5">{{ ucfirst($oldVersion->status) }}</p>
                            </div>
                        </div>
                    @else
                        <div class="text-gray-400 text-sm italic py-4">
                            Tidak ada versi sebelumnya.
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-lg font-bold text-green-600">Current Version</h2>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-semibold">NEW</span>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Edited By</p>
                            <p class="font-semibold text-gray-700 mt-0.5">{{ $newVersion->editor->name ?? 'System' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Edited At</p>
                            <p class="font-semibold text-gray-700 mt-0.5">{{ $newVersion->edited_at->format('d M Y H:i') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Status</p>
                            <p class="font-semibold text-gray-700 mt-0.5">{{ ucfirst($newVersion->status) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm overflow-hidden">
                    <div class="bg-red-50/50 border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                        <div>
                            <h2 class="font-bold text-red-700 text-lg">Previous Content</h2>
                            @if ($oldVersion)
                                <p class="text-xs text-gray-500 mt-0.5">
                                    {{ $oldVersion->edited_at->format('d M Y H:i') }} •
                                    {{ $oldVersion->editor->name ?? 'System' }}
                                </p>
                            @endif
                        </div>
                        <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full font-semibold">OLD</span>
                    </div>

                    <div class="p-6 overflow-auto max-h-[900px]">
                        @if ($oldVersion)
                            <article class="prose max-w-none prose-sm">
                                {!! $oldVersion->content !!}
                            </article>
                        @else
                            <div class="text-gray-400 text-sm italic py-4">
                                Tidak ada versi sebelumnya.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm overflow-hidden">
                    <div class="bg-green-50/50 border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                        <div>
                            <h2 class="font-bold text-green-700 text-lg">Current Content</h2>
                            <p class="text-xs text-gray-500 mt-0.5">
                                {{ $newVersion->edited_at->format('d M Y H:i') }} •
                                {{ $newVersion->editor->name ?? 'System' }}
                            </p>
                        </div>
                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold">NEW</span>
                    </div>

                    <div class="p-6 overflow-auto max-h-[900px]">
                        <article class="prose max-w-none prose-sm diff-wrapper">
                            @if ($diff)
                                {!! $diff !!}
                            @else
                                {!! $newVersion->content !!}
                            @endif
                        </article>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        ins {
            background: #dcfce7;
            color: #166534;
            text-decoration: none;
            padding: 2px 4px;
            border-radius: 4px;
        }

        del {
            background: #fee2e2;
            color: #991b1b;
            padding: 2px 4px;
            border-radius: 4px;
        }

        .diff-wrapper img,
        .prose img {
            max-width: 100%;
            border-radius: 12px;
        }

        .prose table {
            width: 100%;
            border-collapse: collapse;
        }

        .prose table td,
        .prose table th {
            border: 1px solid #e5e7eb;
            padding: 10px;
        }

        .prose pre {
            background: #111827;
            color: #f9fafb;
            padding: 16px;
            border-radius: 12px;
            overflow-x: auto;
        }

        .prose blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 16px;
            color: #4b5563;
        }
    </style>
@endsection
