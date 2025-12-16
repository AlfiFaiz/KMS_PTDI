<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>
        <label class="font-semibold">Nomor Dokumen</label>
        <input type="text" name="nomor" class="form-control" value="{{ $qms->nomor ?? old('nomor') }}" required>
    </div>

    <div>
        <label class="font-semibold">Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ $qms->judul ?? old('judul') }}" required>
    </div>

    <div>
        <label class="font-semibold">Date Issued</label>
        <input type="date" name="date_issued" class="form-control"
            value="{{ $qms->date_issued ?? old('date_issued') }}" required>
    </div>

    <div>
        <label class="font-semibold">ORG</label>
        <input type="text" name="org" class="form-control" value="{{ $qms->org ?? old('org') }}" required>
    </div>

    <div>
        <label class="font-semibold">Revision</label>
        <input type="number" name="rev" class="form-control" value="{{ $qms->rev ?? old('rev') }}" required>
    </div>

    <div>
        <label class="font-semibold">Amend</label>
        <input type="number" name="amend" class="form-control" value="{{ $qms->amend ?? old('amend') }}">
    </div>

    <div>
        <label class="font-semibold">Affected Function</label>
        <input type="text" name="affected_function" class="form-control"
            value="{{ $qms->affected_function ?? old('affected_function') }}" required>
    </div>

    <div>
        <label class="font-semibold">Type</label>
        <select name="type" class="form-control" required>
            @php
                $types = ['FORM', 'MANUAL', 'PROCEDURE', 'WORK INSTRUCTION', 'PERSONAL ROSTER', 'TRAINING'];
            @endphp

            @foreach ($types as $t)
                <option value="{{ $t }}" @if (isset($qms) && $qms->type == $t) selected @endif>
                    {{ $t }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-span-2">
        <label class="font-semibold">Upload File</label>
        <input type="file" name="file_path" class="form-control">

        @isset($qms)
            <p class="mt-2 text-sm text-gray-600">
                File saat ini:
                <a href="{{ asset('storage/qms_files/' . $qms->file_path) }}" target="_blank"
                    class="text-blue-600 underline">
                    {{ $qms->file_path }}
                </a>
            </p>
        @endisset
    </div>

</div>
