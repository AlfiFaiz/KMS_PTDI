@extends('layouts.admin')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    <div class="p-6 space-y-8">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-xl shadow-lg">
            <h1 class="text-3xl font-bold">Dashboard Admin</h1>
            <p class="text-lg mt-1">Selamat datang, <span class="font-semibold">{{ auth()->user()->name }}</span></p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
    <!-- Total User -->
    <a href="{{ route('users.index') }}" 
       class="p-5 bg-gray-50 rounded-xl shadow-md border-l-4 border-blue-500 hover:bg-blue-100 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 font-semibold">Total User</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $countUsers }}</h2>
            </div>
            <i class="fa-solid fa-users text-4xl text-blue-500 opacity-80"></i>
        </div>
    </a>

    <!-- Total Dokumen QMS -->
    <a href="{{ route('qms.index') }}" 
       class="p-5 bg-gray-50 rounded-xl shadow-md border-l-4 border-green-500 hover:bg-green-100 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 font-semibold">Total Dokumen QMS</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $countQms }}</h2>
            </div>
            <i class="fa-solid fa-file-lines text-4xl text-green-500 opacity-80"></i>
        </div>
    </a>

    <!-- Total Perusahaan -->
    <a href="{{ route('companies.index') }}" 
       class="p-5 bg-gray-50 rounded-xl shadow-md border-l-4 border-indigo-500 hover:bg-indigo-100 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 font-semibold">Total Perusahaan</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $countCompanies }}</h2>
            </div>
            <i class="fa-solid fa-building text-4xl text-indigo-500 opacity-80"></i>
        </div>
    </a>

    <!-- Total Sertifikat -->
    <a href="{{ route('certificates.index') }}" 
       class="p-5 bg-gray-50 rounded-xl shadow-md border-l-4 border-yellow-500 hover:bg-yellow-100 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 font-semibold">Total Sertifikat</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $countCertificates }}</h2>
            </div>
            <i class="fa-solid fa-certificate text-4xl text-yellow-500 opacity-80"></i>
        </div>
    </a>

    <!-- Total Aircraft Program -->
    <a href="{{ route('aircraft-programs.index') }}" 
       class="p-5 bg-gray-50 rounded-xl shadow-md border-l-4 border-red-500 hover:bg-red-100 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 font-semibold">Total Aircraft Program</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $countPrograms }}</h2>
            </div>
            <i class="fa-solid fa-plane text-4xl text-red-500 opacity-80"></i>
        </div>
    </a>
</div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Chart Aircraft Program -->
    <div class="bg-gray-50 p-6 rounded-xl shadow-md">
        <h3 class="text-xl font-bold text-blue-700 mb-4">
            Distribusi Aircraft Program per Perusahaan
        </h3>
        <canvas id="chartDokumen"></canvas>
    </div>

    <!-- Chart Role User -->

    <div class="bg-gray-50 p-6 rounded-xl shadow-md flex justify-center">
        <h3 class="text-xl font-bold text-purple-700 mb-4">
            Distribusi Role User
        </h3>
    <div class="w-64 h-64"> <!-- batasi ukuran -->
        <canvas id="chartRoles"></canvas>
    </div>
</div>
</div>




        <!-- Aktivitas Terbaru -->
        <div class="bg-gray-50 p-6 rounded-xl shadow-md">

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

    </div>
    <script>
        const ctx = document.getElementById('chartDokumen').getContext('2d');
        const chartDokumen = new Chart(ctx, {
            type: 'bar', // bisa 'line', 'pie', dll
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Aircraf Program per Perusahaan',
                    data: @json($chartData),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
    const ctxRoles = document.getElementById('chartRoles').getContext('2d');
    new Chart(ctxRoles, {
        type: 'doughnut',
        data: {
            labels: @json($roleLabels), // misalnya ['Admin','Manajemen','Pelanggan']
            datasets: [{
                data: @json($roleData),   // jumlah masing-masing role
                backgroundColor: ['#2563eb','#22c55e','#f59e0b']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection
