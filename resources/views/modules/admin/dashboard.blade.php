@extends('layouts.admin')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    <div class="p-4 space-y-6">

        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-5 rounded-xl shadow-sm">
            <h1 class="text-xl font-bold tracking-tight">Dashboard Kontrol KMS</h1>
            <p class="text-xs opacity-90 mt-0.5">Selamat datang kembali, <span
                    class="font-semibold">{{ auth()->user()->name }}</span> (Administrator)</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-3.5">
            @php
                $stats = [
                    [
                        'label' => 'Knowledge Base',
                        'count' => $countKnowledge,
                        'route' => 'knowledge.index',
                        'color' => 'blue',
                        'icon' => 'fa-book-open-reader',
                    ],
                    [
                        'label' => 'Wiki System',
                        'count' => $countWiki,
                        'route' => 'wiki.index',
                        'color' => 'teal',
                        'icon' => 'fa-book',
                    ],
                    [
                        'label' => 'Dokumen QMS',
                        'count' => $countQms,
                        'route' => 'qms.index',
                        'color' => 'green',
                        'icon' => 'fa-file-shield',
                    ],
                    [
                        'label' => 'Certificates',
                        'count' => $countCert,
                        'route' => 'certificates.index',
                        'color' => 'amber',
                        'icon' => 'fa-certificate',
                    ],
                    [
                        'label' => 'Informations',
                        'count' => $countInfo,
                        'route' => 'infos.index',
                        'color' => 'purple',
                        'icon' => 'fa-circle-info',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <a href="{{ route($stat['route']) }}"
                    class="p-4 bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-{{ $stat['color'] == 'teal' ? '[#14b8a6]' : ($stat['color'] == 'amber' ? '[#f59e0b]' : $stat['color'] . '-500') }} hover:shadow-md transition-all duration-200 group">
                    <div class="flex items-center justify-between">
                        <div class="min-w-0">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider truncate">
                                {{ $stat['label'] }}</p>
                            <h2 class="text-xl font-black text-gray-800 mt-0.5">{{ $stat['count'] }}</h2>
                        </div>
                        <i
                            class="fa-solid {{ $stat['icon'] }} text-lg text-{{ $stat['color'] == 'teal' ? '[#14b8a6]' : ($stat['color'] == 'amber' ? '[#f59e0b]' : $stat['color'] . '-500') }} opacity-40 group-hover:opacity-90 group-hover:scale-110 transition-all duration-200"></i>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col">
                <h3 class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                    Top Kategori Terpopuler Wiki System
                </h3>
                <div class="h-52 flex-1 relative">
                    <canvas id="chartWikiKategori"></canvas>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col">
                <h3 class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Top Kategori Knowledge Base
                </h3>
                <div class="h-52 flex-1 relative">
                    <canvas id="chartKbKategori"></canvas>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center">
                <h3
                    class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider text-left w-full flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                    Komparasi Rasio Akumulasi Fitur KMS
                </h3>
                <div class="h-52 w-full flex justify-center relative">
                    <canvas id="chartSemuaFitur"></canvas>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center">
                <h3
                    class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider text-left w-full flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    Distribusi Otoritas & Hak Akses User
                </h3>
                <div class="h-52 w-full flex justify-center relative">
                    <canvas id="chartRoles"></canvas>
                </div>
            </div>

        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wider flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                Aktivitas Log KMS Terbaru
            </h3>
            <div class="max-h-44 overflow-y-auto pr-2 custom-scrollbar">
                <ul class="space-y-2.5 text-xs text-gray-600">
                    @foreach ($activities as $activity)
                        <li
                            class="border-b border-gray-100 pb-2 last:border-0 last:pb-0 flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <span
                                    class="font-semibold text-blue-600">{{ $activity->user->name ?? 'Sistem Mutu' }}</span>
                                <span class="text-gray-500">{{ $activity->description }}</span>
                            </div>
                            <span
                                class="text-[10px] text-gray-400 whitespace-nowrap bg-gray-50 px-1.5 py-0.5 rounded border border-gray-100">{{ $activity->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

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

        const globalBarScales = {
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

        // 1. CHART BAR: KATEGORI REPOSITORI WIKI
        const ctxWiki = document.getElementById('chartWikiKategori').getContext('2d');
        new Chart(ctxWiki, {
            type: 'bar',
            data: {
                labels: @json($wikiLabels),
                datasets: [{
                    label: 'Jumlah Artikel Wiki',
                    data: @json($wikiData),
                    backgroundColor: 'rgba(20, 184, 166, 0.75)',
                    hoverBackgroundColor: 'rgba(20, 184, 166, 0.9)',
                    borderRadius: 5
                }]
            },
            options: {
                ...globalChartOptions,
                scales: globalBarScales
            }
        });

        // 2. CHART BAR: KATEGORI KNOWLEDGE BASE
        const ctxKb = document.getElementById('chartKbKategori').getContext('2d');
        new Chart(ctxKb, {
            type: 'bar',
            data: {
                labels: @json($kbLabels),
                datasets: [{
                    label: 'Jumlah Materi KB',
                    data: @json($kbData),
                    backgroundColor: 'rgba(37, 99, 235, 0.75)',
                    hoverBackgroundColor: 'rgba(37, 99, 235, 0.9)',
                    borderRadius: 5
                }]
            },
            options: {
                ...globalChartOptions,
                scales: globalBarScales
            }
        });

        // 3. CHART POLAR AREA: AKUMULASI VOLUME DATA SEMUA FITUR KMS
        const ctxSemuaFitur = document.getElementById('chartSemuaFitur').getContext('2d');
        new Chart(ctxSemuaFitur, {
            type: 'polarArea',
            data: {
                labels: @json($kmsFeatureLabels),
                datasets: [{
                    data: @json($kmsFeatureData),
                    backgroundColor: [
                        'rgba(37, 99, 235, 0.65)', // KB (Blue)
                        'rgba(20, 184, 166, 0.65)', // Wiki (Teal)
                        'rgba(34, 197, 94, 0.65)', // QMS (Green)
                        'rgba(245, 158, 11, 0.65)', // Certificates (Amber)
                        'rgba(168, 85, 247, 0.65)' // Infos (Purple)
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

        // 4. CHART DOUGHNUT: DISTRIBUSI ROLE USER
        const ctxRoles = document.getElementById('chartRoles').getContext('2d');
        new Chart(ctxRoles, {
            type: 'doughnut',
            data: {
                labels: @json($roleLabels),
                datasets: [{
                    data: @json($roleData),
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ec4899', '#8b5cf6'],
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
