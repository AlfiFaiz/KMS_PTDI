<?php

namespace App\Observers;

use App\Models\ActivityLog;

class GenericObserver
{
    public function created($model)
    {
        $this->log('Create', $model);
    }

    public function updated($model)
    {
        $this->log('Update', $model);
    }

    public function deleted($model)
    {
        $this->log('Delete', $model);
    }

    private function log($action, $model)
    {
        if (!$model)
            return;

        $userId = auth()->id() ?? request()->user()?->id;

        $label = $this->getLabel($model);

        ActivityLog::create([
            'user_id' => $userId,
            'action' => $action . ' ' . class_basename($model),
            'description' => $this->buildDescription($action, $model, $label),
        ]);
    }

    private function getLabel($model)
    {
        foreach (['name', 'judul', 'title', 'program', 'nomor'] as $field) {
            if (!empty($model->$field)) {
                return $model->$field;
            }
        }

        return class_basename($model) . ' #' . $model->id;
    }

    private function buildDescription($action, $model, $label)
    {
        return match ($action) {
            'Create' => "Menambahkan " . class_basename($model) . ": " . $label,
            'Update' => "Mengupdate " . class_basename($model) . ": " . $label,
            'Delete' => "Menghapus " . class_basename($model) . ": " . $label,
        };
    }
}