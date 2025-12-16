<div class="grid grid-cols-1 gap-4">
    <div>
        <label class="font-semibold">Nama Task</label>
        <input type="text" name="name" value="{{ old('name', $task->name ?? '') }}" class="form-control" required>
    </div>
    <div>
        <label class="font-semibold">Deskripsi</label>
        <textarea name="description" class="form-control">{{ old('description', $task->description ?? '') }}</textarea>
    </div>
</div>
