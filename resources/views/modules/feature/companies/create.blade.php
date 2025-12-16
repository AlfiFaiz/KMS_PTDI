@extends('layouts.admin')

@section('page-title', 'Tambah Perusahaan')

@section('content')

    <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-xl">

        <h2 class="text-2xl font-bold text-blue-700 mb-4">Tambah Perusahaan</h2>

        <form action="{{ route('companies.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="font-semibold">Nama Perusahaan</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="font-semibold">Alamat</label>
                <input type="text" name="address" class="form-control">
            </div>

            <div class="mb-3">
                <label class="font-semibold">Telepon</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan
            </button>

            <a href="{{ route('companies.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                Batal
            </a>
        </form>

    </div>

@endsection
