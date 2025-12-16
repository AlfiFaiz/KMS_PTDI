@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Summary of Work Package')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Summary of Work Package</h2>

        <!-- Info Program -->
        <div class="mb-4">
            <p><strong>Aircraft Type:</strong> {{ $program->aircraft_type }}</p>
            <p><strong>Serial No:</strong> {{ $program->serial_number }}</p>
            <p><strong>Registration:</strong> {{ $program->registration }}</p>
            <p><strong>Owner:</strong> {{ $program->company->name }}</p>
        </div>

        <!-- Form -->
        <form id="summaryForm">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold">Contract Number</label>
                <input type="text" name="contract_number" class="border p-2 rounded w-full md:w-1/3"
                    value="{{ $summary->contract_number ?? '' }}">
            </div>

            <table class="table w-full border-collapse border border-gray-400 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-400 p-2">No</th>
                        <th class="border border-gray-400 p-2">Item</th>
                        <th class="border border-gray-400 p-2">Status (OK/N/A)</th>
                        <th class="border border-gray-400 p-2">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grouped = collect($items)->groupBy('section');
                        $rowNumber = 1;
                    @endphp

                    @foreach ($grouped as $section => $sectionItems)
                        <tr class="bg-blue-100">
                            <td colspan="4" class="border border-gray-400 p-2 font-bold">{{ $section }}</td>
                        </tr>
                        @foreach ($sectionItems as $index => $item)
                            <tr>
                                <td class="border border-gray-400 p-2">{{ $rowNumber++ }}</td>
                                <td class="border border-gray-400 p-2">
                                    <input type="hidden" name="items[{{ $rowNumber }}][section]"
                                        value="{{ $item['section'] }}">
                                    <input type="hidden" name="items[{{ $rowNumber }}][item]"
                                        value="{{ $item['item'] }}">
                                    {{ $item['item'] }}
                                </td>
                                <td class="border border-gray-400 p-2">
                                    <select name="items[{{ $rowNumber }}][status]" class="border p-1 rounded w-full">
                                        <option value="">-- pilih --</option>
                                        <option value="OK"
                                            {{ !empty($item['status']) && $item['status'] == 'OK' ? 'selected' : '' }}>OK
                                        </option>
                                        <option value="N/A"
                                            {{ !empty($item['status']) && $item['status'] == 'N/A' ? 'selected' : '' }}>N/A
                                        </option>
                                    </select>
                                </td>
                                <td class="border border-gray-400 p-2">
                                    <input type="text" name="items[{{ $rowNumber }}][remarks]"
                                        value="{{ $item['remarks'] ?? '' }}" class="border p-1 rounded w-full">
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>


            <div class="mt-4 flex space-x-2">

                <a href="{{ route('work-package.download', $summary->id) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded">
                    Download PDF
                </a>

            </div>
        </form>
    </div>

    <!-- Modal Notifikasi -->
    <div id="successModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-md">
            <h3 class="text-lg font-bold mb-2">Berhasil</h3>
            <p>Summary berhasil disimpan!</p>
            <button onclick="document.getElementById('successModal').classList.add('hidden')"
                class="mt-3 px-4 py-2 bg-blue-600 text-white rounded">Tutup</button>
        </div>
    </div>

    <script>
        document.getElementById('saveBtn').addEventListener('click', function() {
            let form = document.getElementById('summaryForm');
            let formData = new FormData(form);

            fetch("{{ route('work-package.ajax-update', $program->id) }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('successModal').classList.remove('hidden');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Terjadi error saat menyimpan");
                });
        });
    </script>
    <script>
        function autoSave() {
            let form = document.getElementById('summaryForm');
            let formData = new FormData(form);

            fetch("{{ route('work-package.ajax-update', $program->id) }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // tampilkan pop up notifikasi
                        let modal = document.getElementById('successModal');
                        modal.classList.remove('hidden');
                        // otomatis hilang setelah 2 detik
                        setTimeout(() => {
                            modal.classList.add('hidden');
                        }, 2000);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Terjadi error saat menyimpan");
                });
        }

        // pasang listener ke semua input dan select
        document.querySelectorAll('#summaryForm input, #summaryForm select').forEach(el => {
            el.addEventListener('change', autoSave);
            el.addEventListener('input', autoSave);
        });
    </script>
@endsection
