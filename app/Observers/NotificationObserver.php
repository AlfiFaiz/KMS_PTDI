<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Qms;
use App\Models\AircraftProgram;
use App\Models\EngineeringOrder;
use App\Models\Notification;
use App\Models\User;
use App\Models\Pelanggan;

class NotificationObserver
{
    public function created(Model $model)
    {
        if ($model instanceof Qms) {
            $this->notifyAllPelanggan("Dokumen QMS '{$model->judul}' baru ditambahkan");
        } elseif ($model instanceof AircraftProgram) {
            $this->notifyPelangganByCompany($model, "Aircraft Program '{$model->program}' baru ditambahkan");
        } elseif ($model instanceof EngineeringOrder) {
            $this->notifyEngineeringOrder(
                $model,
                "Engineering Order '{$model->task->name}' baru ditambahkan pada Aircraft Program '{$model->aircraftProgram->program}'"
            );

        }
    }

    public function updated(Model $model)
    {
        if ($model instanceof Qms) {
            $this->notifyAllPelanggan("Dokumen QMS '{$model->judul}' diperbarui");
        } elseif ($model instanceof AircraftProgram) {
            $this->notifyPelangganByCompany($model, "Aircraft Program '{$model->program}' diperbarui");
        } elseif ($model instanceof EngineeringOrder) {
            $this->notifyEngineeringOrder($model, "Engineering Order '{$model->task->name}' diperbarui pada Aircraft Program '{$model->aircraftProgram->program}'");
        }
    }

    /**
     * Notifikasi ke semua pelanggan (untuk QMS).
     */
    protected function notifyAllPelanggan(string $message): void
    {
        User::where('role', 'pelanggan')->pluck('id')->each(function ($id) use ($message) {
            Notification::create([
                'user_id' => $id,
                'message' => $message,
            ]);
        });
    }

    /**
     * Notifikasi hanya ke pelanggan dengan company_id sama (untuk Aircraft Program).
     */
    protected function notifyPelangganByCompany(AircraftProgram $program, string $message): void
    {
        $pelanggan = Pelanggan::where('company_id', $program->company_id)->get();

        foreach ($pelanggan as $p) {
            Notification::create([
                'user_id' => $p->user_id, // pakai user_id dari tabel pelanggan
                'message' => $message,
            ]);
        }
    }

    /**
     * Notifikasi untuk Engineering Order berdasarkan Aircraft Program.
     */
    protected function notifyEngineeringOrder(EngineeringOrder $order, string $message): void
    {
        $program = $order->aircraftProgram; // relasi harus ada di model EngineeringOrder

        if (!$program) {
            return;
        }

        $pelanggan = Pelanggan::where('company_id', $program->company_id)->get();

        foreach ($pelanggan as $p) {
            Notification::create([
                'user_id' => $p->user_id,
                'message' => $message,
            ]);
        }
    }
}