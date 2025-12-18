@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Engineering Orders for ' . $program->program)

@section('content')
    <br>
    <div class="bg-gray-50 p-6 rounded-xl shadow-md mb-6">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Detail Aircraft Program</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p><span class="font-semibold">Program:</span> {{ $program->program }}</p>
                <p><span class="font-semibold">Aircraft Type:</span> {{ $program->aircraft_type }}</p>
                <p><span class="font-semibold">Registration:</span> {{ $program->registration }}</p>
            </div>
            <div>
                <p><span class="font-semibold">Company:</span> {{ $program->company->name }}</p>
                @if ($program->image)
                    <p class="mt-2"><span class="font-semibold">Image:</span></p>
                    <img src="{{ asset('storage/aircraft_images/' . $program->image) }}" class="w-48 rounded shadow">
                @endif
            </div>
        </div>
        <a href="{{ url()->previous() }}"
            class="bg-gray-700 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-900">
            Kembali
        </a>
    </div>
    @php
        $totalOrders = $program->engineeringOrders->count();
        $finishedOrders = $program->engineeringOrders->whereNotNull('finish_date')->whereNotNull('insp_stamp')->count();
        $progress = $totalOrders > 0 ? round(($finishedOrders / $totalOrders) * 100) : 0;
    @endphp
    <div class="w-full bg-gray-200 rounded-full h-4">
        <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $progress }}%"></div>
    </div>
    <small>{{ $finishedOrders }}/{{ $totalOrders }} selesai ({{ $progress }}%)</small>
    <br>
    <br>


    <div class="bg-gray-50 p-6 rounded-xl shadow-md">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold text-blue-700">Engineering Orders - {{ $program->program }}</h2>
            <a href="{{ route('engineering-orders.create', $program->id) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded">
                + Tambah Engineering Order
            </a>
        </div>
        <!-- Pencarian & Filter -->
        <div class="mb-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Search -->
            <input type="text" id="search" class="border p-2 rounded w-full md:w-1/3"
                placeholder="Cari berdasarkan Nomor EO atau Task..." onkeyup="filterTable()">

            <!-- Filter Type -->
            <select id="filterType" class="border p-2 rounded w-full md:w-1/3" onchange="filterTable()">
                <option value="">-- Semua Type --</option>
                <option value="Basic Re-assy and Functional Test">Basic Re-assy and Functional Test</option>
                <option value="Customizing Functional Test">Customizing Functional Test</option>
                <option value="Flight Line">Flight Line</option>
                <option value="Maintenance">Maintenance</option>
                <option value="SB, ASB, AND EASB">SB, ASB, AND EASB</option>
            </select>

        </div>
        @if (session('success'))
            <div class="p-3 bg-green-200 text-green-800 rounded mb-4">{{ session('success') }}</div>
        @endif


        <table class="table w-full" id="eoTable">
            <thead class="bg-gray-100">
                <tr>
                    <th>No</th>
                    <th>Task</th>
                    <th>Start</th>
                    <th>Finish</th>
                    <th>Type</th>
                    <th>Insp Stamp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $o)
                    <tr>
                        <td>{{ $o->engineering_order_no }}</td>
                        <td>{{ $o->task->name }}</td>
                        <td>{{ $o->start_date }}</td>
                        <td>{{ $o->finish_date }}</td>
                        <td>{{ $o->type_order }}</td>
                        <td>{{ $o->insp_stamp }}</td>
                        <td>
                            <a href="{{ route('engineering-orders.edit', [$program->id, $o->id]) }}"
                                class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="{{ route('engineering-orders.destroy', [$program->id, $o->id]) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Hapus EO ini?')">
                                @csrf @method('DELETE')
                                <button class="px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-center mt-4 gap-4">
            <a href="{{ route('aircraft.report', $program->id) }}"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Download Report (PDF)
            </a>

        </div>

        <div class="mt-4">{{ $orders->links() }}</div>

    </div>
    <script>
        function filterTable() {
            let search = document.getElementById("search").value.toLowerCase();
            let filterType = document.getElementById("filterType").value.toLowerCase();
            let table = document.getElementById("eoTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let nomor = rows[i].getElementsByTagName("td")[0]?.textContent.toLowerCase() || "";
                let task = rows[i].getElementsByTagName("td")[1]?.textContent.toLowerCase() || "";
                let type = rows[i].getElementsByTagName("td")[4]?.textContent.toLowerCase() || "";

                let matchesSearch = nomor.includes(search) || task.includes(search);
                let matchesFilter = filterType === "" || type === filterType;

                rows[i].style.display = matchesSearch && matchesFilter ? "" : "none";
            }
        }
    </script>
@endsection
