@extends('layouts.admin')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    <div class="p-4 space-y-6"> <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-4 rounded-lg shadow-md">
            <h1 class="text-xl font-bold">Dashboard Admin</h1>
            <p class="text-sm opacity-90">Selamat datang, <span class="font-semibold">{{ auth()->user()->name }}</span></p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
            @php
                $stats = [
                    ['label' => 'Total User', 'count' => $countUsers, 'route' => 'users.index', 'color' => 'blue', 'icon' => 'fa-users'],
                    ['label' => 'Dokumen QMS', 'count' => $countQms, 'route' => 'qms.index', 'color' => 'green', 'icon' => 'fa-file-lines'],
                    ['label' => 'Perusahaan', 'count' => $countCompanies, 'route' => 'companies.index', 'color' => 'indigo', 'icon' => 'fa-building'],
                    ['label' => 'Sertifikat', 'count' => $countCertificates, 'route' => 'certificates.index', 'color' => 'yellow', 'icon' => 'fa-certificate'],
                    ['label' => 'Aircraft Program', 'count' => $countPrograms, 'route' => 'aircraft-programs.index', 'color' => 'red', 'icon' => 'fa-plane'],
                ];
            @endphp

            @foreach($stats as $stat)
            <a href="{{ route($stat['route']) }}" 
               class="p-3 bg-white rounded-lg shadow-sm border-l-4 border-{{ $stat['color'] }}-500 hover:bg-{{ $stat['color'] }}-50 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-tight">{{ $stat['label'] }}</p>
                        <h2 class="text-lg font-black text-gray-800">{{ $stat['count'] }}</h2>
                    </div>
                    <i class="fa-solid {{ $stat['icon'] }} text-xl text-{{ $stat['color'] }}-500 opacity-60"></i>
                </div>
            </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-xs font-bold text-blue-700 mb-3 uppercase tracking-wider">Distribusi Program per Perusahaan</h3>
                <div class="h-48"> <canvas id="chartDokumen"></canvas>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex flex-col items-center">
                <h3 class="text-xs font-bold text-purple-700 mb-3 uppercase tracking-wider text-center w-full">Distribusi Role User</h3>
                <div class="h-48 w-full flex justify-center"> <canvas id="chartRoles"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-xs font-bold text-blue-700 mb-3 uppercase tracking-wider">Aktivitas Terbaru</h3>
            <div class="max-h-40 overflow-y-auto pr-2">
                <ul class="space-y-2 text-xs text-gray-700">
                    @foreach ($activities as $activity)
                        <li class="border-b border-gray-50 pb-1 last:border-0">
                            <span class="font-bold text-blue-600">{{ $activity->user->name ?? 'System' }}</span>
                            {{ $activity->description }}
                            <span class="text-[10px] text-gray-400 italic">({{ $activity->created_at->diffForHumans() }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Opsi Chart agar tidak membesar secara otomatis
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: { boxWidth: 10, font: { size: 10 } }
                }
            }
        };

        const ctx = document.getElementById('chartDokumen').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Program',
                    data: @json($chartData),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });

        const ctxRoles = document.getElementById('chartRoles').getContext('2d');
        new Chart(ctxRoles, {
            type: 'doughnut',
            data: {
                labels: @json($roleLabels),
                datasets: [{
                    data: @json($roleData),
                    backgroundColor: ['#2563eb','#22c55e','#f59e0b']
                }]
            },
            options: chartOptions
        });
    </script>
@endsection