<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\ActivityLog;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => 'Logout',
            'description' => $event->user->name . ' logout',
        ]);
    }
}