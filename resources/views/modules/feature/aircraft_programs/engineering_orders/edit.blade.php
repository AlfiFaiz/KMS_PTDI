@extends('layouts.admin')

@section('title', 'Edit Engineering Order')
@section('page-title', 'Edit Engineering Order')

@section('content')
    <div class="bg-gray-50 p-6 rounded-xl shadow-md w-full max-w-4xl">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">
            Edit Engineering Order untuk {{ $program->program }}
        </h2>

        <form action="{{ route('engineering-orders.update', [$program->id, $order->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('modules.feature.aircraft_programs.engineering_orders.form', ['order' => $order])

            <div class="mt-4 flex space-x-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                <a href="{{ route('engineering-orders.index', $program->id) }}"
                    class="px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
