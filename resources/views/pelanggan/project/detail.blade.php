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
            <div class="bg-white p-6 rounded-xl shadow-md mt-6">
                <h2 class="text-2xl font-bold text-blue-700 mb-4">Detail Aircraft Program</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><span class="font-semibold">Program:</span> {{ $aircraft->program }}</p>
                        <p><span class="font-semibold">Aircraft Type:</span> {{ $aircraft->aircraft_type }}</p>
                        <p><span class="font-semibold">Registration:</span> {{ $aircraft->registration }}</p>
                    </div>
                    <div>
                        <p><span class="font-semibold">Company:</span> {{ $aircraft->company->name }}</p>
                        @if ($aircraft->image)
                            <p class="mt-2"><span class="font-semibold">Image:</span></p>
                            <img src="{{ asset('storage/aircraft_images/' . $aircraft->image) }}"
                                class="w-48 rounded shadow">
                        @else
                            <span class="text-gray-400">No Image</span>
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
