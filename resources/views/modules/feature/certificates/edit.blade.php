@extends('layouts.admin')

@section('page-title', 'Edit Sertifikat')

@section('content')

    <div class="bg-gray-50 p-6 rounded-xl shadow-md w-full max-w-3xl">

        <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Sertifikat</h2>

        <form action="{{ route('certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('modules.feature.certificates.form', ['certificate' => $certificate])

            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update
            </button>

            <a href="{{ route('certificates.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                Batal
            </a>
        </form>

    </div>

@endsection
