@extends('layouts.admin')

@section('title', 'Tambah Task')
@section('page-title', 'Tambah Task')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-3xl">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Tambah Task</h2>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            @include('modules.feature.aircraft_programs.tasks.form')
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
        </form>
    </div>
@endsection
