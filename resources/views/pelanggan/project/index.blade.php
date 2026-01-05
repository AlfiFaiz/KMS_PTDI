@extends('layouts.pelanggan')

@section('title', 'Project')
@section('content')
   <div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
    <div class="bg-black bg-opacity-50 min-h-screen flex flex-col items-center justify-start py-10">
        <div class="container mx-auto px-4 md:px-6 lg:px-12 py-12">

            <!-- Search Bar -->
            <div class="mb-6">
                <input type="text" id="searchInput" placeholder="Cari pesawat..."
                    class="w-full p-3 border border-gray-400 rounded-lg focus:ring focus:ring-blue-300"
                    onkeyup="searchAircrafts()">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" id="aircraftContainer">
                @forelse ($aircraftPrograms as $program)
                    @php
                        $orders = \App\Models\EngineeringOrder::where('aircraft_id', $program->id)->get();
                        $totalOrders = $orders->count();
                        $completedOrders = $orders->whereNotNull('finish_date')->whereNotNull('insp_stamp')->count();
                        $progressPercentage = $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100, 2) : 0;
                    @endphp

                    <div class="bg-blue-900 bg-opacity-80 shadow-md rounded-lg p-3 flex flex-col gap-3 aircraft-item"
     data-program="{{ strtolower($program->program) }}"
     data-type="{{ strtolower($program->aircraft_type) }}"
     data-registration="{{ strtolower($program->registration) }}"
     data-serial="{{ strtolower($program->serial_number) }}"
     data-company="{{ strtolower($program->company->name ?? '') }}"
     data-wbs="{{ strtolower($program->wbs_no) }}">

                        <!-- Gambar & Progress -->
                        <div class="flex items-center gap-3">
                            <div
                                class="bg-gray-200 p-1 rounded-lg shadow-md inline-flex items-center justify-center w-24 h-24">
                                <img src="{{ asset('storage/aircraft_images/' . $program->image) }}" alt="Image"
                                    class="max-w-full max-h-full object-contain rounded-lg">
                            </div>
                            <div class="flex-1">
                                <div class="w-full bg-gray-700 rounded-full h-4">
                                    <div class="bg-green-500 h-4 rounded-full transition-all duration-300"
                                        style="width: {{ $progressPercentage }}%;"></div>
                                </div>
                                <p class="text-xs text-white mt-1 text-right">{{ $progressPercentage }}%</p>
                            </div>
                        </div>

                        <!-- Informasi Pesawat -->
                       <div class="text-white" style="text-align: left;">
    <p style="font-weight: 900; font-size: 1.125rem; line-height: 1.2; text-transform: uppercase; color: #ffffff;">
        {{ $program->program }}
    </p>
    <p style="color: #60a5fa; font-weight: 700; font-size: 12px; margin-top: 2px; text-transform: uppercase;">
        {{ $program->aircraft_type }} | {{ $program->registration }}
    </p>

    <div style="margin-top: 10px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 8px;">
        <p style="font-size: 11px; color: #cbd5e1; margin-bottom: 2px;">
            <span style="color: #94a3b8;">S/N:</span> {{ $program->serial_number ?? '-' }}
        </p>
        <p style="font-size: 11px; color: #cbd5e1; margin-bottom: 2px;">
            <span style="color: #94a3b8;">WBS:</span> {{ $program->wbs_no ?? '-' }}
        </p>
        <p style="font-size: 11px; color: #cbd5e1;">
            <span style="color: #94a3b8;">Contract:</span> {{ $program->contract_no ?? '-' }}
        </p>
    </div>

    <p style="color: #3b82f6; font-size: 11px; font-weight: 800; margin-top: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
        <i class="fa-solid fa-building" style="margin-right: 4px;"></i>
        {{ $program->company->name ?? 'N/A' }}
    </p>
</div>

                        <!-- Tombol Detail -->
                        <a href="{{ route('project.detail', $program->id) }}"
                            class="bg-black text-white px-3 py-1 rounded-lg text-xs text-center hover:bg-gray-800 flex-1">
                            Detail Engineering Order
                        </a>

                        <!-- Tombol Work Package Summary -->
                        <a href="{{ route('work-package.summary', $program->id) }}"
                            class="bg-green-600 text-white px-3 py-1 rounded-lg text-xs text-center hover:bg-green-700 flex-1">
                            Summary of Work Package
                        </a>


                    </div>
                @empty
                    <div class="col-span-3 text-center text-white bg-red-600 bg-opacity-70 rounded-lg p-4">
                        Tidak ada project
                    </div>
                @endforelse
            </div>
        </div>

        <!-- SCRIPT SEARCH -->
        <script>
            function searchAircrafts() {
                let input = document.getElementById("searchInput").value.toLowerCase();
                let aircrafts = document.querySelectorAll(".aircraft-item");

                aircrafts.forEach(aircraft => {
                    let program = aircraft.getAttribute("data-program");
                    let type = aircraft.getAttribute("data-type");
                    let registration = aircraft.getAttribute("data-registration");
                    let customer = aircraft.getAttribute("data-customer");

                    if (program.includes(input) || type.includes(input) || registration.includes(input) || customer
                        .includes(input)) {
                        aircraft.style.display = "block";
                    } else {
                        aircraft.style.display = "none";
                    }
                });
            }
        </script>
    @endsection
