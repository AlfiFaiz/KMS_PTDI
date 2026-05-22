@extends('layouts.inspektor')

@section('page-title', 'Dashboard Inspektor')

@section('content')
    <div class="p-6 space-y-8">

        <!-- HEADER -->
        <div
            class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-cyan-500 text-white p-6 rounded-2xl shadow-lg">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

            <h1 class="text-3xl font-bold">Dashboard Inspektor</h1>
            <p class="text-white/80 mt-1">
                Selamat datang, <span class="font-semibold">{{ auth()->user()->name }}</span>
            </p>
        </div>

        <!-- STAT CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- QMS -->
            <div
                class="group bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-1 transition">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-400 font-semibold">
                            Dokumen QMS
                        </p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-1">
                            {{ $countQms }}
                        </h2>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                        <i class="fa-solid fa-file-lines text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- CERT -->
            <div
                class="group bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-1 transition">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-400 font-semibold">
                            Sertifikat
                        </p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-1">
                            {{ $countCertificates }}
                        </h2>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center">
                        <i class="fa-solid fa-certificate text-yellow-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- PROGRAM -->
            <div
                class="group bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-1 transition">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-400 font-semibold">
                            Aircraft Program
                        </p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-1">
                            {{ $countPrograms }}
                        </h2>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                        <i class="fa-solid fa-plane text-red-500 text-xl"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- CHART -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-blue-700 uppercase tracking-wider mb-4">
                Revisi Dokumen QMS
            </h3>

            <div class="h-64">
                <canvas id="chartQms"></canvas>
            </div>
        </div>

        <!-- ACTIVITY -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-blue-700 uppercase tracking-wider mb-4">
                Aktivitas Terbaru
            </h3>

            <ul class="space-y-3 text-sm">
                @foreach ($activities as $activity)
                    <li class="flex justify-between gap-4 border-b border-gray-100 pb-2 last:border-0">

                        <div>
                            <span class="font-semibold text-blue-600">
                                {{ $activity->user->name ?? 'System' }}
                            </span>
                            <span class="text-gray-600">
                                {{ $activity->description }}
                            </span>
                        </div>

                        <span class="text-xs text-gray-400 whitespace-nowrap">
                            {{ $activity->created_at->diffForHumans() }}
                        </span>

                    </li>
                @endforeach
            </ul>
        </div>

    </div>

    <!-- CHART -->
    <script>
        const ctx = document.getElementById('chartQms');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Revisi',
                    data: @json($chartData),
                    backgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection
