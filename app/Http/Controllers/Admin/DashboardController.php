<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Qms;
use App\Models\Certificate;
use App\Models\AircraftProgram;
use App\Models\ActivityLog;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        $chartLabels = Company::pluck('name');
        $chartData = Company::withCount('pelanggan')->pluck('pelanggan_count');

        $activities = ActivityLog::with('user')->latest()->take(10)->get();
        $notifications = Notification::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'chartLabels',
            'chartData',
            'activities',
            'notifications'
        ));
    }
}