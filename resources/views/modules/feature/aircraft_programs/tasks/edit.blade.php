@extends('layouts.admin')

@section('title', 'Edit Task')
@section('page-title', 'Edit Task')

@section('content')
    <div class="bg-gray-50 p-6 rounded-xl shadow-md w-full max-w-3xl">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Task</h2>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- gunakan partial form --}}
            @include('modules.feature.aircraft_programs.tasks.form', ['task' => $task])

            <div class="mt-4 flex space-x-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
