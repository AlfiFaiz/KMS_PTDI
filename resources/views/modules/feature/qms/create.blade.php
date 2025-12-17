@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Tambah Dokumen QMS')

@section('content')

    <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-3xl">

        <h2 class="text-2xl font-bold text-blue-700 mb-4">Tambah Dokumen QMS</h2>

        <form action="{{ route('qms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('modules.feature.qms.form')

            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan
            </button>

            <a href="{{ route('qms.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                Batal
            </a>
        </form>

    </div>

@endsection
