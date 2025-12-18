@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Edit Dokumen QMS')

@section('content')

    <div class="bg-gray-50 p-6 rounded-xl shadow-md w-full max-w-3xl">

        <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Dokumen QMS</h2>

        <form action="{{ route('qms.update', $qms->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('modules.feature.qms.form', ['qms' => $qms])

            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update
            </button>

            <a href="{{ route('qms.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                Batal
            </a>
        </form>

    </div>

@endsection
