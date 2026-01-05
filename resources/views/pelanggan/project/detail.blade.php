@extends('layouts.pelanggan')

@section('title', 'Detail Engineering Order')
@section('content')
    <div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
    <div class="bg-black bg-opacity-50 min-h-screen flex flex-col items-center justify-start py-10">
        <div class="container mx-auto px-4 md:px-6 lg:px-12 py-12">
            <!-- Judul -->
            <div class="text-center mt-4 text-white">
                <h1 class="text-3xl font-extrabold">Engineering Orders for {{ $aircraft->aircraft_type }}</h1>
                <p class="text-lg">{{ $aircraft->registration }} - {{ $aircraft->company->name }}</p>
            </div>
            @php

                $totalOrders = $orders->count();
                $completedOrders = $orders->whereNotNull('finish_date')->whereNotNull('insp_stamp')->count();
                $progressPercentage = $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100, 2) : 0;
            @endphp
            <!-- Detail Aircraft Program -->
            <div class="bg-white p-8 rounded-xl shadow-lg mt-6 border border-gray-100">
    <h2 class="text-2xl font-black text-blue-800 mb-6 uppercase tracking-tight border-b-2 border-blue-800 pb-2 inline-block">
        Detail Aircraft Program
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-4">
            <div class="flex flex-col border-b border-gray-100 pb-2">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Program</span>
                <span class="text-gray-900 font-semibold text-lg">{{ $aircraft->program }}</span>
            </div>

            <div class="flex flex-col border-b border-gray-100 pb-2">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Aircraft Type</span>
                <span class="text-gray-900 font-semibold text-lg">{{ $aircraft->aircraft_type }}</span>
            </div>

            <div class="flex flex-col border-b border-gray-100 pb-2">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Registration</span>
                <span class="text-gray-900 font-semibold text-lg">{{ $aircraft->registration }}</span>
            </div>

            <div class="flex flex-col border-b border-gray-100 pb-2">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Serial Number</span>
                <span class="text-gray-900 font-semibold">{{ $aircraft->serial_number ?? '-' }}</span>
            </div>

            <div class="flex flex-col border-b border-gray-100 pb-2">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">WBS No</span>
                <span class="text-gray-900 font-semibold">{{ $aircraft->wbs_no ?? '-' }}</span>
            </div>

            <div class="flex flex-col border-b border-gray-100 pb-2">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Contract No</span>
                <span class="text-gray-900 font-semibold">{{ $aircraft->contract_no ?? '-' }}</span>
            </div>
        </div>

        <div class="space-y-6">
            <div class="flex flex-col bg-blue-50 p-4 rounded-lg">
                <span class="text-xs font-bold text-blue-700 uppercase tracking-wider">Owner / Company</span>
                <span class="text-blue-900 font-black text-xl">{{ $aircraft->company->name ?? 'N/A' }}</span>
            </div>

            <div>
    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-2">Aircraft Visualization</span>
    @if ($aircraft->image && $aircraft->image !== 'default.jpg')
        <div class="relative inline-block">
            <img src="{{ asset('storage/aircraft_images/' . $aircraft->image) }}"
                 class="w-48 h-32 object-cover rounded-lg shadow-md border-2 border-white transition-transform hover:scale-105">
        </div>
    @else
        <div class="w-48 h-32 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200 flex flex-col items-center justify-center">
            <i class="fa-solid fa-plane text-gray-300 text-xl mb-1"></i>
            <span class="text-gray-400 text-[10px] font-medium italic">No Photo</span>
        </div>
    @endif
</div>

            @if($aircraft->document_file)
            <div class="pt-2">
                <a href="{{ asset('storage/aircraft_documents/' . $aircraft->document_file) }}" 
                   class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition-all shadow-lg text-sm"
                   target="_blank">
                    <i class="fa-solid fa-file-pdf"></i> VIEW ATTACHED DOCUMENT
                </a>
            </div>
            @endif
        </div>
    </div>
    <br>
    <div class="flex-1">
        <div class="w-full bg-gray-700 rounded-full h-4">
            <div class="bg-green-500 h-4 rounded-full transition-all duration-300"
            style="width: {{ $progressPercentage }}%;"></div>
        </div>
        <p class="text-xs text-black mt-1 text-right">{{ $progressPercentage }}%</p>
    </div>
</div>
</div>


            <!-- Wrapper Scroll -->
            <div class="mt-6 bg-white p-4 rounded-lg shadow-lg">
                <div class="overflow-auto max-h-[400px] border border-gray-600 p-2">

                    @foreach ($orders->groupBy('type_order') as $type => $group)
                        <!-- Header Type Order -->
                        <h2 class="bg-blue-600 text-white text-lg font-bold px-4 py-2">{{ $type }}</h2>

                        <!-- Tabel -->
                        <table class="w-full border-collapse border border-gray-600 mb-4">
                            <thead class="bg-gray-300">
                                <tr>
                                    <th class="border border-gray-600 px-4 py-2">No</th>
                                    <th class="border border-gray-600 px-4 py-2">Engineering Order No</th>
                                    <th class="border border-gray-600 px-4 py-2">Subject Title</th>
                                    <th class="border border-gray-600 px-4 py-2">Start Date</th>
                                    <th class="border border-gray-600 px-4 py-2">Finish Date</th>
                                    <th class="border border-gray-600 px-4 py-2">Insp Stamp</th>
                                    <th class="border border-gray-600 px-4 py-2">Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="text-black">
                                @foreach ($group as $index => $order)
                                    <tr class="hover:bg-gray-200">
                                        <td class="border border-gray-600 px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border border-gray-600 px-4 py-2">{{ $order->engineering_order_no }}
                                        </td>
                                        <td class="border border-gray-600 px-4 py-2">{{ $order->task->name }}</td>
                                        <td class="border border-gray-600 px-4 py-2">{{ $order->start_date }}</td>
                                        <td class="border border-gray-600 px-4 py-2">{{ $order->finish_date }}</td>
                                        <td class="border border-gray-600 px-4 py-2">{{ $order->insp_stamp }}</td>
                                        <td class="border border-gray-600 px-4 py-2 text-center">
                                            @if ($order->finish_date && $order->insp_stamp)
                                                ✅
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach

                </div>
            </div>

            <div class="flex justify-center mt-4 gap-4">
                <a href="{{ route('aircraft.report', $aircraft->id) }}"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Download Report (PDF)
                </a>

            </div>
            <!-- Tombol Kembali -->
            <div class="flex justify-center mt-6">

                <a href="{{ url()->previous() }}"
                    class="bg-gray-700 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-900">
                    Kembali
                </a>
            </div>

        </div>
    </div>
@endsection
