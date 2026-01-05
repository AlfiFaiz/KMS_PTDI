@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Summary of Work Package')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-blue-700">Summary of Work Package</h2>
            
            <a href="{{ route('work-package.download', $summary->id) }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition shadow-sm">
                 <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                 </svg>
                 Download PDF Report
             </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-3 mb-8 p-5 bg-gray-50 rounded-lg border border-gray-100">
    <div class="space-y-3">
        <div class="flex items-start">
            <div class="w-40 flex-shrink-0 font-semibold text-gray-600">Aircraft Type</div>
            <div class="px-2 text-gray-400">:</div>
            <div class="font-bold text-gray-800">{{ $program->aircraft_type }}</div>
        </div>

        <div class="flex items-start">
            <div class="w-40 flex-shrink-0 font-semibold text-gray-600">Serial No</div>
            <div class="px-2 text-gray-400">:</div>
            <div class="font-bold text-gray-800">{{ $program->serial_number ?? '-' }}</div>
        </div>

        <div class="flex items-start">
            <div class="w-40 flex-shrink-0 font-semibold text-gray-600">Registration</div>
            <div class="px-2 text-gray-400">:</div>
            <div class="font-mono text-blue-700 font-bold uppercase">{{ $program->registration }}</div>
        </div>
    </div>

    <div class="space-y-3">
        <div class="flex items-start">
            <div class="w-40 flex-shrink-0 font-semibold text-gray-600">Owner</div>
            <div class="px-2 text-gray-400">:</div>
            <div class="font-bold text-gray-800">{{ $program->company->name }}</div>
        </div>

        <div class="flex items-start">
            <div class="w-40 flex-shrink-0 font-semibold text-gray-600">WBS No</div>
            <div class="px-2 text-gray-400">:</div>
            <div class="font-bold text-gray-800 break-all">{{ $program->wbs_no ?? '-' }}</div>
        </div>

        <div class="flex items-start">
            <div class="w-40 flex-shrink-0 font-semibold text-gray-600 uppercase text-[11px] leading-tight">Dokumen Return to Service (RTS)</div>
            <div class="px-2 text-gray-400">:</div>
            <div class="min-w-0 flex-1">
                @if($program->document_file)
                    <a href="{{ asset('storage/aircraft_documents/' . $program->document_file) }}" 
                       target="_blank" 
                       class="text-blue-600 hover:text-blue-800 underline flex items-center group">
                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                        </svg>
                        <span class="truncate font-bold text-sm">
                            {{ basename($program->document_file) }}
                        </span>
                    </a>
                @else
                    <span class="text-gray-400 font-normal italic text-xs">No file uploaded</span>
                @endif
            </div>
        </div>
    </div>
</div>

        <form id="summaryForm">
            @csrf
            <div class="overflow-x-auto border border-gray-300 rounded-lg">
                <table class="table w-full border-collapse text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border-b border-gray-300 p-3 text-left w-12">No</th>
                            <th class="border-b border-gray-300 p-3 text-left">Item Description</th>
                            <th class="border-b border-gray-300 p-3 text-center w-40">Status (OK/N/A)</th>
                            <th class="border-b border-gray-300 p-3 text-left">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grouped = collect($items)->groupBy('section');
                            $rowNumber = 1;
                        @endphp

                        @foreach ($grouped as $section => $sectionItems)
                            <tr class="bg-blue-600 text-white">
                                <td colspan="4" class="p-2 font-bold uppercase tracking-wider pl-4">{{ $section }}</td>
                            </tr>
                            @foreach ($sectionItems as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="border-b border-gray-200 p-3 text-center text-gray-500">{{ $rowNumber++ }}</td>
                                    <td class="border-b border-gray-200 p-3 font-medium">
                                        <input type="hidden" name="items[{{ $rowNumber }}][section]" value="{{ $item['section'] }}">
                                        <input type="hidden" name="items[{{ $rowNumber }}][item]" value="{{ $item['item'] }}">
                                        {{ $item['item'] }}
                                    </td>
                                    <td class="border-b border-gray-200 p-3">
                                        <select name="items[{{ $rowNumber }}][status]" class="w-full border-gray-300 p-1.5 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">-- pilih --</option>
                                            <option value="OK" {{ ($item['status'] ?? '') == 'OK' ? 'selected' : '' }}>OK</option>
                                            <option value="N/A" {{ ($item['status'] ?? '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                        </select>
                                    </td>
                                    <td class="border-b border-gray-200 p-3">
                                        <input type="text" name="items[{{ $rowNumber }}][remarks]"
                                            value="{{ $item['remarks'] ?? '' }}" 
                                            class="w-full border-gray-300 p-1.5 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Catatan tambahan...">
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-between items-center">
                <span class="text-xs text-gray-500 italic">*Data disimpan secara otomatis saat Anda melakukan perubahan.</span>
            </div>
        </form>
    </div>

    <div id="successModal" class="hidden fixed bottom-10 right-10 z-50 transform transition-all">
        <div class="bg-gray-900 text-white px-6 py-3 rounded-xl shadow-2xl flex items-center space-x-3">
            <div class="bg-green-500 rounded-full p-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <span class="text-sm font-bold">Progress Tersimpan!</span>
        </div>
    </div>
@endsection