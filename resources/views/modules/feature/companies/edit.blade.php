@extends('layouts.admin')

@section('page-title', 'Edit Perusahaan')

@section('content')

    <div class="bg-gray-50 p-6 rounded-xl shadow-md w-full max-w-xl">

        <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Perusahaan</h2>

        <form action="{{ route('companies.update', $company->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="font-semibold">Nama Perusahaan</label>
                <input type="text" name="name" class="form-control" value="{{ $company->name }}" required>
            </div>

            <div class="mb-3">
                <label class="font-semibold">Alamat</label>
                <input type="text" name="address" class="form-control" value="{{ $company->address }}">
            </div>

            <div class="mb-3">
                <label class="font-semibold">Telepon</label>
                <input type="text" name="phone" class="form-control" value="{{ $company->phone }}">
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update
            </button>

            <a href="{{ route('companies.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                Batal
            </a>
        </form>

    </div>

@endsection
