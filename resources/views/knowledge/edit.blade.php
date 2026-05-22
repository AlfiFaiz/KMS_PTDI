{{-- resources/views/knowledge/edit.blade.php --}}

@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Edit Knowledge')

@section('content')

    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6">

        <!-- BREADCRUMB & HEADER -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                <a href="{{ route('knowledge.index') }}" class="hover:text-blue-600 transition-colors">Knowledge
                    Management</a>
                <i class="fa-solid fa-chevron-right text-[9px] text-gray-400"></i>
                <span class="text-gray-800 font-medium">Edit</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                Edit Knowledge Base
            </h1>
            <p class="text-gray-500 text-xs mt-1">
                Perbarui informasi atau lampiran dokumen basis pengetahuan internal.
            </p>
        </div>

        <!-- ERROR VALIDATION SYSTEM -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200/60 text-red-800 rounded-xl shadow-sm">
                <div class="flex items-center gap-2 mb-2 font-semibold text-xs uppercase tracking-wider text-red-700">
                    <i class="fa-solid fa-circle-exclamation text-sm"></i>
                    Periksa Kembali Isian Anda
                </div>
                <ul class="list-disc ml-5 space-y-0.5 text-xs text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM CARD ARCHITECTURE -->
        <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm overflow-hidden">
            <form action="{{ route('knowledge.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6 sm:p-8 space-y-5">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Judul Dokumen</label>
                    <input type="text" name="title" value="{{ old('title', $data->title) }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-gray-50/30"
                        placeholder="Masukkan judul informasi utama...">
                </div>

                <!-- Deskripsi -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Deskripsi Singkat</label>
                    <textarea name="description" rows="5" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all bg-gray-50/30"
                        placeholder="Tuliskan rangkuman isi materi dokumen disini...">{{ old('description', $data->description) }}</textarea>
                </div>

                <!-- Kategori -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Klasifikasi
                        Kategori</label>
                    <div class="relative">
                        <select name="category" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 bg-gray-50/30
                            focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all appearance-none cursor-pointer">
                            <option value="" disabled>-- Pilih Kategori --</option>
                            <option value="Maintenance"
                                {{ old('category', $data->category) == 'Maintenance' ? 'selected' : '' }}>Maintenance
                            </option>
                            <option value="Safety" {{ old('category', $data->category) == 'Safety' ? 'selected' : '' }}>
                                Safety</option>
                            <option value="Inspection"
                                {{ old('category', $data->category) == 'Inspection' ? 'selected' : '' }}>Inspection</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400 text-xs">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <!-- File Upload Component -->
                <div class="space-y-2 pt-2 border-t border-gray-100">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Unggah Berkas Baru</label>
                    <input type="file" name="file"
                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 
                        file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 
                        border border-gray-200 bg-gray-50/50 p-1.5 rounded-xl transition-all">
                    <p class="text-[11px] text-gray-400">Pilih berkas PDF baru jika ingin memperbarui lampiran saat ini.</p>

                    @if ($data->file)
                        <div
                            class="mt-3 flex items-center gap-2 p-2.5 bg-gray-50 border border-gray-200/60 rounded-xl max-w-full">
                            <div class="p-1.5 bg-white border border-gray-200 rounded-lg text-gray-400 shadow-sm shrink-0">
                                <i class="fa-solid fa-paperclip text-xs"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">File Aktif
                                    Sekarang</span>
                                <span class="block text-xs text-gray-600 font-medium truncate"
                                    title="{{ $data->file }}">{{ basename($data->file) }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- BUTTON ACTIONS CONTROLLER -->
                <div class="flex items-center justify-between pt-5 border-t border-gray-100">
                    <a href="{{ route('knowledge.index') }}"
                        class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-200 
                        text-xs font-semibold text-gray-600 rounded-xl hover:bg-gray-50 hover:text-gray-800 transition-all shadow-sm">
                        Batalkan
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center px-5 py-2 bg-blue-600 hover:bg-blue-700 
                        text-white text-xs font-semibold rounded-xl transition-all shadow-sm shadow-blue-500/10">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

    </div>

@endsection
