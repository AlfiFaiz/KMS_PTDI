@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Edit Sertifikat')

@section('content')
    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('certificates.index') }}"
                class="w-9 h-9 rounded-xl border border-gray-200 bg-white flex items-center justify-center text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors shadow-sm">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                    Edit Sertifikat
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui berkas informasi atau masa aktif sertifikat perusahaan.
                </p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200/80 shadow-sm overflow-hidden">
            <form action="{{ route('certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-6">
                    @include('modules.feature.certificates.form', ['certificate' => $certificate])
                </div>

                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 flex items-center justify-end gap-2.5">
                    <a href="{{ route('certificates.index') }}"
                        class="px-4 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 text-sm font-semibold text-center transition-colors shadow-sm">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-sm shadow-blue-500/10 transition-all duration-200 flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
