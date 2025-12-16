@extends('layouts.admin')

@section('page-title', 'Tambah Sertifikat')

@section('content')

    <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-3xl">

        <h2 class="text-2xl font-bold text-blue-700 mb-4">Tambah Sertifikat</h2>

        <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('modules.feature.certificates.form')

            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan
            </button>

            <a href="{{ route('certificates.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                Batal
            </a>
        </form>

    </div>

@endsection
