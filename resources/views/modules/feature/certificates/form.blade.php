<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>
        <label class="font-semibold">Nomor Sertifikat</label>
        <input type="text" name="nomor" class="form-control" value="{{ $certificate->nomor ?? old('nomor') }}"
            required>
    </div>

    <div>
        <label class="font-semibold">Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ $certificate->judul ?? old('judul') }}"
            required>
    </div>

    <div>
        <label class="font-semibold">Date Issued</label>
        <input type="date" name="date_issued" class="form-control"
            value="{{ $certificate->date_issued ?? old('date_issued') }}" required>
    </div>

    <div>
        <label class="font-semibold">Issued By</label>
        <input type="text" name="issued_by" class="form-control"
            value="{{ $certificate->issued_by ?? old('issued_by') }}" required>
    </div>

    <div class="col-span-2">
        <label class="font-semibold">Upload File Sertifikat</label>
        <input type="file" name="file_path" class="form-control">

        @isset($certificate)
            <p class="mt-2 text-sm text-gray-600">
                File saat ini:
                <a href="{{ asset('storage/certificates/' . $certificate->file_path) }}" target="_blank"
                    class="text-blue-600 underline">
                    {{ $certificate->file_path }}
                </a>
            </p>
        @endisset
    </div>

</div>
