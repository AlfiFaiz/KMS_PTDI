<div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Nomor Dokumen</label>
            <div class="relative">
                <input type="text" name="nomor" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                    placeholder="Contoh: QMS-PROC-01"
                    value="{{ $qms->nomor ?? old('nomor') }}" required>
            </div>
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Judul Dokumen</label>
            <input type="text" name="judul" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                placeholder="Masukkan judul lengkap..."
                value="{{ $qms->judul ?? old('judul') }}" required>
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Date Issued</label>
            <input type="date" name="date_issued" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                value="{{ $qms->date_issued ?? old('date_issued') }}" required>
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Type</label>
            <select name="type" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-white outline-none transition-all appearance-none cursor-pointer" required>
                <option value="" disabled selected>-- Pilih Tipe --</option>
                @php
                    $types = ['MANUAL','QUALITY DOCUMENT','PROCEDURE','WORK INSTRUCTION','FORM'];
                @endphp
                @foreach ($types as $t)
                    <option value="{{ $t }}" @if (isset($qms) && $qms->type == $t) selected @endif>
                        {{ $t }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Revision</label>
                <input type="number" name="rev" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                    value="{{ $qms->rev ?? old('rev') }}" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Amend</label>
                <input type="number" name="amend" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                    value="{{ $qms->amend ?? old('amend') }}">
            </div>
        </div>

<div class="col-span-1 md:col-span-2 bg-gray-50 p-4 rounded-lg border-2 border-dashed border-gray-200">
    <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Upload Dokumen (PDF/DOCX)</label>
    <input type="file" name="file_path" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
    
    @isset($qms)
        <div class="mt-3 p-3 bg-white rounded border border-gray-200 shadow-sm">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
                
                <div class="ml-3 overflow-hidden">
                    <p class="text-xs font-medium text-gray-500 uppercase">File saat ini:</p>
                    <a href="{{ asset('storage/qms_files/' . $qms->file_path) }}" 
                       target="_blank" 
                       class="block text-sm font-semibold text-blue-600 hover:text-blue-800 underline break-all">
                        {{ $qms->file_path }}
                    </a>
                </div>
            </div>
        </div>
    @endisset
</div>        
    </div>
</div>