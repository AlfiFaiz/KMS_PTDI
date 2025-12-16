<?php
namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Pelanggan;
use App\Models\Qms;
use App\Models\Certificate;
use App\Models\AircraftProgram;
use App\Models\ActivityLog;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        $companies = Company::withCount('pelanggan')->get();
        $chartLabels = $companies->pluck('name');
        $chartData = $companies->pluck('pelanggan_count');

        $activities = ActivityLog::with('user')->latest()->take(10)->get();
        $notifications = Notification::latest()->take(10)->get();

        return view('manajemen.dashboard', compact(
            'chartLabels',
            'chartData',
            'activities',
            'notifications'
        ));
    }
}