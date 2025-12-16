<?php
namespace App\Http\Controllers\Inspektor;

use App\Http\Controllers\Controller;
use App\Models\Qms;
use App\Models\Certificate;
use App\Models\ActivityLog;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        $chartLabels = Qms::pluck('judul');
        $chartData = Qms::pluck('rev');

        $activities = ActivityLog::with('user')->latest()->take(10)->get();
        $notifications = Notification::latest()->take(10)->get();

        return view('inspektor.dashboard', compact(
            'chartLabels',
            'chartData',
            'activities',
            'notifications'
        ));
    }
}