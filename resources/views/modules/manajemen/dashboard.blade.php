@extends('layouts.manajemen')

@section('page-title', 'Dashboard Manajemen')

@section('content')
    <div class="p-6 space-y-8">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-xl shadow-lg">
            <h1 class="text-3xl font-bold">Dashboard Manajemen</h1>
            <p class="text-lg mt-1">Selamat datang, <span class="font-semibold">{{ auth()->user()->name }}</span></p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <!-- Total Pelanggan -->
            <div class="p-5 bg-white rounded-xl shadow-md border-l-4 border-blue-500">
                <p class="text-gray-500 font-semibold">Total Pelanggan</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $countPelanggan }}</h2>
                <i class="fa-solid fa-users text-4xl text-blue-500 opacity-80 float-right"></i>
            </div>

            <!-- Total Perusahaan -->
            <div class="p-5 bg-white rounded-xl shadow-md border-l-4 border-indigo-500">
                <p class="text-gray-500 font-semibold">Total Perusahaan</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $countCompanies }}</h2>
                <i class="fa-solid fa-building text-4xl text-indigo-500 opacity-80 float-right"></i>
            </div>

            <!-- Total Dokumen QMS -->
            <div class="p-5 bg-white rounded-xl shadow-md border-l-4 border-green-500">
                <p class="text-gray-500 font-semibold">Total Dokumen QMS</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $countQms }}</h2>
                <i class="fa-solid fa-file-lines text-4xl text-green-500 opacity-80 float-right"></i>
            </div>

            <!-- Total Sertifikat -->
            <div class="p-5 bg-white rounded-xl shadow-md border-l-4 border-yellow-500">
                <p class="text-gray-500 font-semibold">Total Sertifikat</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $countCertificates }}</h2>
                <i class="fa-solid fa-certificate text-4xl text-yellow-500 opacity-80 float-right"></i>
            </div>

            <!-- Total Aircraft Program -->
            <div class="p-5 bg-white rounded-xl shadow-md border-l-4 border-red-500">
                <p class="text-gray-500 font-semibold">Total Aircraft Program</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $countPrograms }}</h2>
                <i class="fa-solid fa-plane text-4xl text-red-500 opacity-80 float-right"></i>
            </div>
        </div>

        <!-- Grafik -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-xl font-bold text-blue-700 mb-4">Distribusi Pelanggan per Perusahaan</h3>
            <canvas id="chartPelanggan"></canvas>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-xl font-bold text-blue-700 mb-4">Aktivitas Terbaru</h3>
            <ul class="space-y-2 text-gray-700">
                @foreach ($activities as $activity)
                    <li class="border-b pb-2">
                        <span class="font-semibold">{{ $activity->user->name ?? 'System' }}</span>
                        {{ $activity->description }}
                        <span class="text-sm text-gray-500">({{ $activity->created_at->diffForHumans() }})</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Notifikasi -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-xl font-bold text-blue-700 mb-4">Notifikasi</h3>
            <ul class="space-y-2 text-gray-700">
                @foreach ($notifications as $notif)
                    <li class="border-b pb-2">
                        <i class="fa-solid fa-bell text-yellow-500 mr-2"></i>
                        {{ $notif->message }}
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('chartPelanggan');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Pelanggan',
                    data: @json($chartData),
                    backgroundColor: '#3b82f6'
                }]
            }
        });
    </script>
@endsection
