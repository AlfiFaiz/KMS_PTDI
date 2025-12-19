<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Qms;
use App\Models\Certificate;
use App\Models\Company;
use App\Models\ActivityLog;
use App\Models\Notification;
use App\Models\AircraftProgram;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        $activities = ActivityLog::with('user')->latest()->take(10)->get();


        switch ($role) {
            case 'admin':
                // Statistik admin: semua entitas
                $countUsers = User::count();
                $countQms = Qms::count();
                $countCompanies = Company::count();
                $countCertificates = Certificate::count();
                $countPrograms = AircraftProgram::count();

                // Ambil semua perusahaan dengan jumlah aircraft program
$companies = Company::withCount('aircraftPrograms')->get();

// Label chart = nama perusahaan
$chartLabels = $companies->pluck('name');

// Data chart = jumlah aircraft program per perusahaan
$chartData = $companies->pluck('aircraft_programs_count');
  // 2. Distribusi Role User
        $roleStats = User::select('role', DB::raw('count(*) as total'))
                        ->groupBy('role')
                        ->get();
        $roleLabels = $roleStats->pluck('role');
        $roleData   = $roleStats->pluck('total');



                $activities = ActivityLog::with('user')->latest()->take(10)->get();
                $notifications = Notification::latest()->take(10)->get();

                return view('modules.admin.dashboard', compact(
                    'countUsers',
                    'countQms',
                    'countCompanies',
                    'countCertificates',
                    'countPrograms',
                    'chartLabels',
                    'chartData',
                    'activities', // pakai nama sama dengan Blade
                     'roleLabels','roleData',

                    'notifications'
                ));

            case 'manajemen':
                // Statistik manajemen: fokus pelanggan
                $countPrograms = AircraftProgram::count();
                $countPelanggan = User::where('role', 'pelanggan')->count();
                $countCompanies = Company::count();
                $countCertificates = Certificate::count();
                $countQms = Qms::count();
                $companies = Company::withCount('pelanggan')->get();
                $chartLabels = $companies->pluck('name');
                $chartData = $companies->pluck('pelanggan_count');

                return view('modules.manajemen.dashboard', compact(
                    'countPelanggan',
                    'chartLabels',
                    'countQms',
                    'countPrograms',
                    'countCertificates',
                    'chartData',
                    'countCompanies',
                    'activities'
                ));

            case 'inspektor':
                // Statistik inspektor: fokus dokumen QMS & sertifikat
                $countQms = Qms::count();
                $countCertificates = Certificate::count();
                $countPrograms = AircraftProgram::count();

                $qms = Qms::all();
                $chartLabels = $qms->pluck('judul');
                $chartData = $qms->pluck('rev');

                return view('modules.inspektor.dashboard', compact(
                    'countQms',
                    'countCertificates',
                    'countPrograms',
                    'chartLabels',
                    'chartData',
                    'activities'
                ));

            case 'pelanggan':
                // Statistik pelanggan: fokus program milik company sendiri
                $programs = AircraftProgram::where('company_id', auth()->user()->company_id)->get();
                $countPrograms = $programs->count();
                $notifications = Notification::where('user_id', auth()->id())
                    ->latest()
                    ->take(10)
                    ->get();
                $unreadCount = Notification::where('user_id', auth()->id())
                    ->whereNull('read_at')
                    ->count();



                $chartLabels = $programs->pluck('program');
                $chartData = $programs->map(fn($p) => $p->tasks()->count()); // contoh: jumlah task per program

                return view('pelanggan.dashboard', compact(
                    'countPrograms',
                    'chartLabels',
                    'chartData',
                    'activities',
                    'notifications',
                    'unreadCount'
                ));
        }
    }
}