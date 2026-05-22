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
use App\Models\Wiki;
use App\Models\Knowledge;
use App\Models\Info;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        // Ambil aktivitas global untuk log widget
        $activities = ActivityLog::with('user')->latest()->take(10)->get();

        // =========================================================================
        // JAMINAN VARIABEL KMS INTI (Didefinisikan global agar tidak undefined di Blade)
        // =========================================================================
        $countKnowledge = Knowledge::count();
        $countWiki = Wiki::count();
        $countQms = Qms::count();
        $countCertificates = Certificate::count(); // Sesuai nama di struktur card dashboard Anda
        $countCert = $countCertificates;    // Alias fallback keamanan
        $countInfo = Info::count();

        // Entitas structural pendukung
        $countUsers = User::count();
        $countCompanies = Company::count();
        $countPrograms = AircraftProgram::count();

        switch ($role) {
            case 'admin':
                // 1. DATA GRAFIK 1: Kategori Terpopuler WIKI (Batang Teal)
                $wikiStats = \App\Models\Wiki::select('category', DB::raw('count(*) as total'))
                    ->whereNotNull('category')
                    ->groupBy('category')
                    ->orderByDesc('total')
                    ->take(5)
                    ->get();
                $wikiLabels = $wikiStats->pluck('category');
                $wikiData = $wikiStats->pluck('total');

                // 2. DATA GRAFIK 2: Kategori Terpopuler KNOWLEDGE BASE (Batang Biru)
                $kbStats = \App\Models\Knowledge::select('category', DB::raw('count(*) as total'))
                    ->whereNotNull('category')
                    ->groupBy('category')
                    ->orderByDesc('total')
                    ->take(5)
                    ->get();
                $kbLabels = $kbStats->pluck('category');
                $kbData = $kbStats->pluck('total');

                // 3. DATA GRAFIK 3: Komparasi Volume Semua Fitur KMS (Polar Area)
                $kmsFeatureLabels = ['Knowledge Base', 'Wiki System', 'Dokumen QMS', 'Certificates', 'Informations'];
                $kmsFeatureData = [$countKnowledge, $countWiki, $countQms, $countCertificates, $countInfo];

                // 4. DATA GRAFIK 4: Distribusi Role User (Doughnut)
                $roleStats = User::select('role', DB::raw('count(*) as total'))->groupBy('role')->get();
                $roleLabels = $roleStats->pluck('role');
                $roleData = $roleStats->pluck('total');

                $notifications = Notification::latest()->take(10)->get();

                return view('modules.admin.dashboard', compact(
                    'countKnowledge',
                    'countWiki',
                    'countQms',
                    'countCertificates',
                    'countCert',
                    'countInfo',
                    'countUsers',
                    'wikiLabels',
                    'wikiData',
                    'kbLabels',
                    'kbData',
                    'kmsFeatureLabels',
                    'kmsFeatureData',
                    'roleLabels',
                    'roleData',
                    'activities',
                    'notifications'
                ));

            case 'manajemen':
                $countPrograms = AircraftProgram::count();
                $countPelanggan = User::where('role', 'pelanggan')->count();
                $countCompanies = Company::count();
                $countCertificates = Certificate::count();
                $countQms = Qms::count();

                // CHART 1: Distribusi Pelanggan per Perusahaan
                $companies = Company::withCount('pelanggan')->get();
                $chartLabels = $companies->pluck('name');
                $chartData = $companies->pluck('pelanggan_count');

                // CHART 2: Distribusi Aircraft Program per Perusahaan
                $companiesWithPrograms = Company::withCount('aircraftPrograms')->get();
                $programLabels = $companiesWithPrograms->pluck('name');
                $programData = $companiesWithPrograms->pluck('aircraft_programs_count');

                // CHART 3: Komparasi Berkas Seluruh Fitur Utama KMS
                $kmsFeatureLabels = ['Knowledge Base', 'Wiki System', 'Dokumen QMS', 'Certificates', 'Informations'];
                $kmsFeatureData = [$countKnowledge, $countWiki, $countQms, $countCertificates, $countInfo];

                // =========================================================================
                // FIX CHART 4: Menggunakan Kolom 'rev' (Revisi) yang Pasti Ada di Model Qms Anda
                // =========================================================================
                $qmsStats = Qms::select('rev', DB::raw('count(*) as total'))
                    ->groupBy('rev')
                    ->orderBy('rev', 'asc')
                    ->get();

                // Mapping label agar informatif (Contoh: "Revision 0", "Revision 1")
                $qmsLabels = $qmsStats->pluck('rev')->map(fn($rev) => 'Revisi ' . ($rev ?? '0'));
                $qmsData = $qmsStats->pluck('total');

                // Fallback jika data Qms masih kosong melompong agar chart tidak hilang
                if ($qmsStats->isEmpty()) {
                    $qmsLabels = ['Dokumen Baru', 'Dokumen Berjalan'];
                    $qmsData = [0, 0];
                }

                $notifications = Notification::latest()->take(10)->get();

                return view('modules.manajemen.dashboard', compact(
                    'countPelanggan',
                    'countQms',
                    'countPrograms',
                    'countCertificates',
                    'countCompanies',
                    'countKnowledge',
                    'countWiki',
                    'countInfo',
                    'chartLabels',
                    'chartData',
                    'programLabels',
                    'programData',
                    'kmsFeatureLabels',
                    'kmsFeatureData',
                    'qmsLabels',
                    'qmsData', // Variabel yang sudah diperbaiki ke kolom 'rev'
                    'activities',
                    'notifications'
                ));
            case 'inspektor':
                // Grafik Inspektor: Kontrol dokumen QMS berdasarkan index revisinya
                $qms = Qms::latest()->take(10)->get();
                $chartLabels = $qms->pluck('judul')->map(fn($judul) => substr($judul, 0, 15) . '...');
                $chartData = $qms->pluck('rev');

                return view('modules.inspektor.dashboard', compact(
                    'countKnowledge',
                    'countWiki',
                    'countQms',
                    'countCertificates',
                    'countCert',
                    'countInfo',
                    'countPrograms',
                    'chartLabels',
                    'chartData',
                    'activities'
                ));

            case 'pelanggan':
                // Saring program kerja dan notifikasi spesifik milik perusahaan pelanggan sendiri
                $userCompanyId = auth()->user()->company_id;

                $programs = AircraftProgram::where('company_id', $userCompanyId)->get();
                $countPrograms = $programs->count();

                // Set count sertifikat khusus milik perusahaan ini saja
                $countCertificates = Certificate::where('company_id', $userCompanyId)->count();
                $countCert = $countCertificates;

                $notifications = Notification::where('user_id', auth()->id())->latest()->take(10)->get();
                $unreadCount = Notification::where('user_id', auth()->id())->whereNull('read_at')->count();

                // Grafik Pelanggan: Jumlah task eksekusi per Aircraft Program
                $chartLabels = $programs->pluck('program');
                $chartData = $programs->map(fn($p) => $p->tasks ? $p->tasks()->count() : 0);

                return view('pelanggan.dashboard', compact(
                    'countKnowledge',
                    'countWiki',
                    'countQms',
                    'countCertificates',
                    'countCert',
                    'countInfo',
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