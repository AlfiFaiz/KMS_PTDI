@extends('layouts.admin')

@section('title', 'Tambah Engineering Order')
@section('page-title', 'Tambah Engineering Order')

@section('content')
    <div class="bg-gray-50 p-6 rounded-xl shadow-md w-full max-w-4xl">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">
            Tambah Engineering Order untuk {{ $program->program }}
        </h2>

        <form action="{{ route('engineering-orders.store', $program->id) }}" method="POST">
            @csrf
            @include('modules.feature.aircraft_programs.engineering_orders.form')

            <div class="mt-4 flex space-x-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                <a href="{{ route('engineering-orders.index', $program->id) }}"
                    class="px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
