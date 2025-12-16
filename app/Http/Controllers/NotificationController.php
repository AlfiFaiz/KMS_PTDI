<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notif = Notification::findOrFail($id);
        $notif->update(['read_at' => now()]);
        return back()->with('success', 'Notifikasi ditandai sudah dibaca');
    }
}
