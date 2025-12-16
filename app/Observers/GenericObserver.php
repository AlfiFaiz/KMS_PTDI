<?php

namespace App\Observers;

use App\Models\ActivityLog;

class GenericObserver
{
    public function created($model)
    {
        $userId = auth()->id();

        // Kalau model User baru dibuat, belum ada auth
        if ($model instanceof \App\Models\User) {
            $userId = null; // atau 0 untuk system
        }

        ActivityLog::create([
            'user_id' => $userId,
            'action' => 'Create ' . class_basename($model),
            'description' => 'Menambahkan ' . class_basename($model) . ': ' . ($model->name ?? $model->judul ?? $model->program ?? ''),
        ]);
    }

    public function updated($model)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Update ' . class_basename($model),
            'description' => 'Mengupdate ' . class_basename($model) . ': ' . ($model->name ?? $model->judul ?? $model->program ?? ''),
        ]);
    }

    public function deleted($model)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Delete ' . class_basename($model),
            'description' => 'Menghapus ' . class_basename($model) . ': ' . ($model->name ?? $model->judul ?? $model->program ?? ''),
        ]);
    }
}