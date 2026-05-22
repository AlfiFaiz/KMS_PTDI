<div class="space-y-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Nomor Dokumen</label>
            <input type="text" name="nomor"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                placeholder="Contoh: QMS-PROC-01" value="{{ $qms->nomor ?? old('nomor') }}" required>
        </div>

        <div>
            <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Judul Dokumen</label>
            <input type="text" name="judul"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                placeholder="Masukkan judul lengkap..." value="{{ $qms->judul ?? old('judul') }}" required>
        </div>

        <div>
            <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Date Issued</label>
            <input type="date" name="date_issued"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                value="{{ $qms->date_issued ?? old('date_issued') }}" required>
        </div>

        <div>
            <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Type</label>
            <div class="relative">
                <select name="type"
                    class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all appearance-none cursor-pointer"
                    required>
                    <option value="" disabled selected>-- Pilih Tipe --</option>
                    @php
                        $types = ['MANUAL', 'QUALITY DOCUMENT', 'PROCEDURE', 'WORK INSTRUCTION', 'FORM'];
                    @endphp
                    @foreach ($types as $t)
                        <option value="{{ $t }}" @if (isset($qms) && $qms->type == $t) selected @endif>
                            {{ $t }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-gray-400">
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Revision</label>
                <input type="number" name="rev"
                    class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                    value="{{ $qms->rev ?? old('rev') }}" required>
            </div>
            <div>
                <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Amend</label>
                <input type="number" name="amend"
                    class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                    value="{{ $qms->amend ?? old('amend') }}">
            </div>
        </div>

        <div class="col-span-1 md:col-span-2 bg-gray-50/40 p-4 rounded-xl border border-dashed border-gray-300">
            <label class="block mb-2 text-xs font-bold text-gray-500 uppercase tracking-wider">Upload Dokumen
                (PDF/DOCX)</label>
            <input type="file" name="file_path"
                class="block w-full text-xs text-gray-500 file:mr-4 file:py-1.5 file:px-3.5 file:rounded-lg file:border file:border-blue-200 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100/80 file:transition-colors cursor-pointer">

            @isset($qms)
                <div class="mt-3 p-3 bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="flex items-start gap-2.5">
                        <div class="w-7 h-7 rounded-md bg-red-50 flex items-center justify-center shrink-0 text-red-500">
                            <i class="fa-solid fa-file-pdf text-sm"></i>
                        </div>
                        <div class="overflow-hidden w-full">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">File Saat Ini</p>
                            <a href="{{ asset('storage/qms_files/' . $qms->file_path) }}" target="_blank"
                                class="block text-xs font-semibold text-blue-600 hover:text-blue-800 underline break-all mt-0.5">
                                {{ $qms->file_path }}
                            </a>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>
</div>
