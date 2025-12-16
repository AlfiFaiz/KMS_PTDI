<?php
namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\AircraftProgram;
use App\Models\ActivityLog;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::where('user_id', auth()->id())->first();
        $programs = AircraftProgram::where('company_id', $pelanggan->company_id)->get();

        $chartLabels = $programs->pluck('program');
        $chartData = $programs->countBy();

        $activities = ActivityLog::with('user')->latest()->take(10)->get();
        $notifications = Notification::where('user_id', auth()->id())->latest()->take(10)->get();

        return view('pelanggan.dashboard', compact(
            'chartLabels',
            'chartData',
            'activities',
            'notifications'
        ));
    }
}