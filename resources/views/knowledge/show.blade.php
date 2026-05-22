@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Knowledge Detail')

@section('content')

    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- BREADCRUMB & BACK NAVIGATION -->
        <div class="flex items-center justify-between pb-4 border-b border-gray-200/60">
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <a href="{{ route('knowledge.index') }}" class="hover:text-blue-600 transition-colors">Knowledge
                    Management</a>
                <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                <span class="text-gray-800 font-medium">Detail</span>
            </div>

            <a href="{{ route('knowledge.index') }}"
                class="inline-flex items-center gap-2 text-xs font-semibold text-gray-600 hover:text-blue-600 bg-white border border-gray-200 px-3 py-1.5 rounded-lg shadow-sm hover:shadow transition-all">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- ===================== -->
        <!-- MAIN INFO CARD        -->
        <!-- ===================== -->
        <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm p-6 sm:p-8">
            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
                <div class="space-y-1 max-w-3xl">
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                        {{ $data->title }}
                    </h1>
                </div>

                <!-- DYNAMIC STATUS BADGE -->
                <div>
                    @if ($data->status == 'approved')
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/50">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Approved
                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200/50">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending Review
                        </span>
                    @endif
                </div>
            </div>

            <p class="text-gray-600 text-sm leading-relaxed mb-6 whitespace-pre-line">
                {{ $data->description }}
            </p>

            <!-- META DATA BLOCKS -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-gray-100">
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Kategori</span>
                    <span
                        class="inline-block mt-1 text-xs font-medium px-2 py-0.5 bg-gray-100 border border-gray-200/60 text-gray-700 rounded-md">
                        {{ $data->category }}
                    </span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Dibuat Oleh</span>
                    <span class="text-xs font-semibold text-gray-700 block mt-1">{{ $data->user->name ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Tanggal Rilis</span>
                    <span
                        class="text-xs font-medium text-gray-500 block mt-1">{{ $data->created_at->format('d M Y') }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Terakhir
                        Diperbarui</span>
                    <span
                        class="text-xs font-medium text-gray-500 block mt-1">{{ $data->updated_at->format('d M Y - H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- PDF VIEWER CONTAINER -->
        <!-- ===================== -->
        <!-- ===================== -->
        <!-- PDF VIEWER CONTAINER  -->
        <!-- ===================== -->
        @if ($data->file)
            @php
                $fileUrl = asset('storage/' . $data->file);
            @endphp

            <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm overflow-hidden">
                <!-- PREVIEW CONTROL HEADER -->
                <div class="px-5 py-3.5 border-b border-gray-100 bg-gray-50/80 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-file-pdf text-red-500 text-base"></i>
                        <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Lampiran Dokumen Utama</span>
                    </div>
                    <a href="{{ $fileUrl }}" target="_blank"
                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Buka Tab Baru
                    </a>
                </div>

                <!-- REALISTIC CANVAS WORKSPACE (Ukuran Dioptimalkan) -->
                <div class="bg-gray-100 p-4 sm:p-6 overflow-auto flex justify-center">
                    <div class="w-full max-w-4xl bg-white shadow-md rounded-xl overflow-hidden border border-gray-300/60">
                        <!-- Tinggi objek diturunkan ke 580px agar lebih proporsional -->
                        <object data="{{ $fileUrl }}" type="application/pdf" width="100%" height="580px"
                            class="w-full max-h-[70vh]">
                            <div class="p-8 text-center bg-gray-50">
                                <i class="fa-solid fa-triangle-exclamation text-amber-500 text-2xl mb-2"></i>
                                <p class="text-sm text-gray-600 font-medium">Browser tidak mendukung peninjauan langsung
                                    PDF.</p>
                                <a href="{{ $fileUrl }}" target="_blank"
                                    class="inline-block mt-3 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition-colors">
                                    Unduh Dokumen PDF
                                </a>
                            </div>
                        </object>
                    </div>
                </div>
            </div>
        @endif

        <!-- ===================== -->
        <!-- DISCUSSION BOX        -->
        <!-- ===================== -->
        <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm p-6 sm:p-8">
            <div class="flex items-center gap-2 mb-6 pb-3 border-b border-gray-100">
                <i class="fa-regular fa-comments text-gray-400 text-lg"></i>
                <h3 class="text-base font-bold text-gray-900 tracking-tight">
                    Kolom Diskusi Internal
                </h3>
            </div>

            <!-- FEEDBACK FORM -->
            <form action="{{ route('knowledge.comment.store', $data->id) }}" method="POST" class="space-y-3 mb-8">
                @csrf
                <div class="relative">
                    <textarea name="comment" rows="3" required
                        class="w-full border border-gray-300 rounded-xl p-4 text-sm text-gray-800 placeholder:text-gray-400 
                        bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                        placeholder="Tulis tanggapan atau pertanyaan diskusi Anda disini..."></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-sm transition-all">
                        Kirim Komentar
                    </button>
                </div>
            </form>

            <!-- COMMENT TILES -->
            <div class="space-y-4">
                @forelse($data->comments as $comment)
                    <div
                        class="p-4 border border-gray-100 rounded-xl bg-gray-50/40 hover:bg-gray-50 transition-colors flex gap-3">

                        <!-- USER AVATAR EMBLEM -->
                        <div
                            class="w-8 h-8 rounded-full bg-blue-100/80 text-blue-700 font-bold text-xs uppercase flex items-center justify-center shrink-0">
                            {{ substr($comment->user->name, 0, 1) }}
                        </div>

                        <!-- META CONTENT BODY -->
                        <div class="flex-1 space-y-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span
                                        class="text-xs font-bold text-gray-900 block sm:inline-block mr-1.5">{{ $comment->user->name }}</span>
                                    <span
                                        class="text-[10px] text-gray-400 font-medium">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>

                                <!-- DELETE COMMENT TRIGGER -->
                                @if ($comment->user_id == auth()->id())
                                    <form action="{{ route('comment.delete', $comment->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus komentar permanen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1 rounded text-gray-400 hover:text-red-600 hover:bg-red-50 transition-all"
                                            title="Hapus Tanggapan">
                                            <i class="fa-regular fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <p class="text-gray-700 text-xs sm:text-sm leading-relaxed">
                                {{ $comment->comment }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 bg-gray-50/30 border border-dashed border-gray-200 rounded-xl">
                        <i class="fa-regular fa-message text-xl mb-1.5 block text-gray-300"></i>
                        <p class="text-xs text-gray-400">Belum ada diskusi aktif pada dokumen ini. Jadilah yang pertama
                            berkomentar.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

@endsection
