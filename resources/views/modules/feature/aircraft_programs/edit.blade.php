@extends('layouts.admin')

@section('page-title', 'Edit Aircraft Program')

@section('content')
    <div class="bg-gray-50 p-6 rounded-xl shadow-md w-full max-w-3xl">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Aircraft Program</h2>

        <form action="{{ route('aircraft-programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('modules.feature.aircraft_programs.form', ['program' => $program])
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            <a href="{{ route('aircraft-programs.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
        </form>
    </div>
@endsection
