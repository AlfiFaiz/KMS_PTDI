@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Summary of Work Package')

@section('content')
    <div class="bg-gray-50 p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Summary of Work Package</h2>

        <!-- Info Program -->
        <div class="mb-4">
            <p><strong>Aircraft Type:</strong> {{ $summary->program->aircraft_type }}</p>
            <p><strong>Serial No:</strong> {{ $summary->program->serial_number }}</p>
            <p><strong>Registration:</strong> {{ $summary->program->registration }}</p>
            <p><strong>Owner:</strong> {{ $summary->program->company->name }}</p>
            <p><strong>Contract No:</strong> {{ $summary->contract_number }}</p>
        </div>

        <!-- Tabel Items -->
        <table class="table w-full border-collapse border border-gray-400 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-400 p-2">No</th>
                    <th class="border border-gray-400 p-2">Section</th>
                    <th class="border border-gray-400 p-2">Item</th>
                    <th class="border border-gray-400 p-2">Status</th>
                    <th class="border border-gray-400 p-2">Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary->items as $index => $item)
                    <tr>
                        <td class="border border-gray-400 p-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-400 p-2">{{ $item->section }}</td>
                        <td class="border border-gray-400 p-2">{{ $item->item }}</td>
                        <td class="border border-gray-400 p-2">{{ $item->status }}</td>
                        <td class="border border-gray-400 p-2">{{ $item->remarks }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <a href="{{ route('work-package.download', $summary->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                Download PDF
            </a>
        </div>
    </div>
@endsection
