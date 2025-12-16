<div class="grid grid-cols-2 gap-4">
    <div>
        <label>Program</label>
        <input type="text" name="program" value="{{ old('program', $program->program ?? '') }}" class="form-control"
            required>
    </div>
    <div>
        <label>Aircraft Type</label>
        <input type="text" name="aircraft_type" value="{{ old('aircraft_type', $program->aircraft_type ?? '') }}"
            class="form-control" required>
    </div>
    <div>
        <label>Registration</label>
        <input type="text" name="registration" value="{{ old('registration', $program->registration ?? '') }}"
            class="form-control" required>
    </div>
    <div>
        <label>Company</label>
        <select name="company_id" class="form-control" required>
            @foreach ($companies as $c)
                <option value="{{ $c->id }}" @selected(old('company_id', $program->company_id ?? '') == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-span-2">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
        @isset($program->image)
            <img src="{{ asset('storage/aircraft_images/' . $program->image) }}" class="w-32 mt-2">
        @endisset
    </div>
</div>
