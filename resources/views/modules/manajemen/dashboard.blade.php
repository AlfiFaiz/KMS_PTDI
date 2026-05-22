@extends('layouts.manajemen')

@section('page-title', 'Dashboard Manajemen')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="p-4 space-y-6">

        {{-- ================= PREMIUM HEADER BANNER ================= --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-5 rounded-xl shadow-sm">
            <h1 class="text-xl font-bold tracking-tight">Dashboard Analisis Manajemen</h1>
            <p class="text-xs opacity-90 mt-0.5">
                Selamat datang kembali,
                <span class="font-semibold text-white">{{ auth()->user()->name }}</span> (Management Board)
            </p>
        </div>

        {{-- ================= HIGH-CONTRAST STAT CARDS MATRIX ================= --}}
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3.5">
            @php
                $stats = [
                    ['label' => 'Total Pelanggan', 'count' => $countPelanggan, 'color' => 'blue', 'icon' => 'fa-users'],
                    ['label' => 'Perusahaan', 'count' => $countCompanies, 'color' => 'indigo', 'icon' => 'fa-building'],
                    ['label' => 'Dokumen QMS', 'count' => $countQms, 'color' => 'green', 'icon' => 'fa-file-lines'],
                    [
                        'label' => 'Sertifikat',
                        'count' => $countCertificates,
                        'color' => 'amber',
                        'icon' => 'fa-certificate',
                    ],
                    ['label' => 'Aircraft Program', 'count' => $countPrograms, 'color' => 'red', 'icon' => 'fa-plane'],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div
                    class="p-4 bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-{{ $stat['color'] == 'amber' ? '[#f59e0b]' : $stat['color'] . '-500' }} hover:shadow-md transition-all duration-200 group">
                    <div class="flex items-center justify-between">
                        <div class="min-w-0">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider truncate">
                                {{ $stat['label'] }}
                            </p>
                            <h2 class="text-xl font-black text-gray-800 mt-0.5">
                                {{ $stat['count'] }}
                            </h2>
                        </div>
                        <i
                            class="fa-solid {{ $stat['icon'] }} text-lg text-{{ $stat['color'] == 'amber' ? '[#f59e0b]' : $stat['color'] . '-500' }} opacity-40 group-hover:opacity-90 group-hover:scale-110 transition-all duration-200"></i>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ================= 4 QUADRANT VISUALIZATION GRID ================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col">
                <h3 class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Distribusi Sebaran Pelanggan per Vendor
                </h3>
                <div class="h-52 flex-1 relative">
                    <canvas id="chartPelanggan"></canvas>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col">
                <h3 class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Distribusi Proyek Aircraft Program
                </h3>
                <div class="h-52 flex-1 relative">
                    <canvas id="chartPrograms"></canvas>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center">
                <h3
                    class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider text-left w-full flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                    Komparasi Volume Berkas Repositori KMS
                </h3>
                <div class="h-52 w-full flex justify-center relative">
                    <canvas id="chartSemuaFitur"></canvas>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center">
                <h3
                    class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider text-left w-full flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    Matriks Fase Distribusi Revisi Dokumen QMS
                </h3>
                <div class="h-52 w-full flex justify-center relative">
                    <canvas id="chartQmsLevels"></canvas>
                </div>
            </div>
        </div>

        {{-- ================= LOWER CONTENT: LOG & NOTIF SIDE BY SIDE ================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- AKTIVITAS LOG TERBARU --}}
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                    Aktivitas Operasional Terbaru
                </h3>
                <div class="max-h-44 overflow-y-auto pr-2 custom-scrollbar">
                    <ul class="space-y-2.5 text-xs text-gray-600">
                        @foreach ($activities as $activity)
                            <li
                                class="border-b border-gray-100 pb-2 last:border-0 last:pb-0 flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <span class="font-semibold text-blue-600">{{ $activity->user->name ?? 'System' }}</span>
                                    <span class="text-gray-500">{{ $activity->description }}</span>
                                </div>
                                <span
                                    class="text-[10px] text-gray-400 whitespace-nowrap bg-gray-50 px-1.5 py-0.5 rounded border border-gray-100">
                                    {{ $activity->created_at->diffForHumans() }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- NOTIFIKASI SISTEM MUTU --}}
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    Notifikasi Masuk Sistem
                </h3>
                <div class="max-h-44 overflow-y-auto pr-2 custom-scrollbar">
                    <ul class="space-y-2.5 text-xs text-gray-600">
                        @forelse ($notifications as $notif)
                            <li class="border-b border-gray-100 pb-2 last:border-0 last:pb-0 flex items-start gap-2.5">
                                <i class="fa-solid fa-bell text-amber-500 mt-0.5 flex-shrink-0"></i>
                                <span class="text-gray-600 leading-relaxed">{{ $notif->message }}</span>
                            </li>
                        @empty
                            <li class="text-gray-400 italic py-2">Tidak ada notifikasi sistem saat ini</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>

    {{-- ================= GENERIC SCRIPT CONFIGURATION ================= --}}
    <script>
        const globalChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 8,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 10,
                            weight: '500'
                        }
                    }
                }
            }
        };

        const barScalesConfig = {
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    font: {
                        size: 9
                    }
                }
            },
            y: {
                grid: {
                    borderDash: [4, 4],
                    color: '#f1f5f9'
                },
                ticks: {
                    font: {
                        size: 10
                    },
                    stepSize: 1
                },
                beginAtZero: true
            }
        };

        // 1. CHART BAR: PELANGGAN
        const ctxPelanggan = document.getElementById('chartPelanggan').getContext('2d');
        new Chart(ctxPelanggan, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Pelanggan',
                    data: @json($chartData),
                    backgroundColor: 'rgba(37, 99, 235, 0.75)',
                    hoverBackgroundColor: 'rgba(37, 99, 235, 0.9)',
                    borderRadius: 5
                }]
            },
            options: {
                ...globalChartOptions,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: barScalesConfig
            }
        });

        // 2. CHART BAR: AIRCRAFT PROGRAM
        const ctxPrograms = document.getElementById('chartPrograms').getContext('2d');
        new Chart(ctxPrograms, {
            type: 'bar',
            data: {
                labels: @json($programLabels),
                datasets: [{
                    label: 'Jumlah Proyek',
                    data: @json($programData),
                    backgroundColor: 'rgba(239, 68, 68, 0.75)',
                    hoverBackgroundColor: 'rgba(239, 68, 68, 0.9)',
                    borderRadius: 5
                }]
            },
            options: {
                ...globalChartOptions,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: barScalesConfig
            }
        });

        // 3. CHART POLAR AREA: AKUMULASI FITUR KMS
        const ctxSemuaFitur = document.getElementById('chartSemuaFitur').getContext('2d');
        new Chart(ctxSemuaFitur, {
            type: 'polarArea',
            data: {
                labels: @json($kmsFeatureLabels),
                datasets: [{
                    data: @json($kmsFeatureData),
                    backgroundColor: [
                        'rgba(37, 99, 235, 0.65)', // Blue
                        'rgba(20, 184, 166, 0.65)', // Teal
                        'rgba(34, 197, 94, 0.65)', // Green
                        'rgba(245, 158, 11, 0.65)', // Amber
                        'rgba(168, 85, 247, 0.65)' // Purple
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                ...globalChartOptions,
                scales: {
                    r: {
                        ticks: {
                            display: false
                        },
                        grid: {
                            color: '#f1f5f9'
                        }
                    }
                }
            }
        });

        // 4. CHART DOUGHNUT: RASIO REVISI DOKUMEN QMS
        const ctxQms = document.getElementById('chartQmsLevels').getContext('2d');
        new Chart(ctxQms, {
            type: 'doughnut',
            data: {
                labels: @json($qmsLabels),
                datasets: [{
                    data: @json($qmsData),
                    backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#ec4899', '#8b5cf6'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                ...globalChartOptions,
                cutout: '72%'
            }
        });
    </script>
@endsection
