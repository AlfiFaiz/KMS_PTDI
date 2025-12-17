<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('certificate', function () {
    return view('certificates');
});
Route::get('about', function () {
    return view('about');
});
Route::get('capabilities', function () {
    return view('capabilities');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

// =======================
// AUTH ROUTES
// =======================

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register (Pelanggan)
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', function () {
    return 'ROUTE POST REGISTER TERPANGGIL';
});


// =======================
// DASHBOARD ROUTES SESUAI ROLE
// =======================

Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

use App\Http\Controllers\Pelanggan\ProjectController as PelangganProjectController;
use App\Http\Controllers\Pelanggan\QmsControllerUser;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/project', [PelangganProjectController::class, 'index'])->name('project.index');
    Route::get('/project/{id}', [PelangganProjectController::class, 'detail'])->name('project.detail');
});

Route::get('/customer/qms/form', [QmsControllerUser::class, 'form'])->name('pelanggan/qms/form');
Route::get('/customer/qms/manual', [QmsControllerUser::class, 'manual'])->name('pelanggan/qms/manual');
Route::get('/customer/qms/procedure', [QmsControllerUser::class, 'procedure'])->name('pelanggan/qms/procedure');
Route::get('/customer/qms/WI', [QmsControllerUser::class, 'WI'])->name('pelanggan/qms/WI');
Route::get('/customer/qms/PP', [QmsControllerUser::class, 'PP'])->name('pelanggan/qms/PP');
Route::get('/customer/qms/training', [QmsControllerUser::class, 'training'])->name('pelanggan/qms/training');


use App\Http\Controllers\QmsController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\AircraftProgramController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EngineeringOrderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\InfoController;

// === Group umum: admin, manajemen, inspektor ===
Route::middleware(['auth', 'exclude.pelanggan'])->group(function () {
    Route::resource('qms', QmsController::class);
    Route::resource('certificates', CertificateController::class);
    Route::resource('aircraft-programs', AircraftProgramController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('infos', InfoController::class);


    // Engineering Orders nested di Aircraft Program
    Route::prefix('aircraft-programs/{aircraftProgramId}')->group(function () {
        Route::get('engineering-orders', [EngineeringOrderController::class, 'index'])->name('engineering-orders.index');
        Route::get('engineering-orders/create', [EngineeringOrderController::class, 'create'])->name('engineering-orders.create');
        Route::post('engineering-orders', [EngineeringOrderController::class, 'store'])->name('engineering-orders.store');
        Route::get('engineering-orders/{id}/edit', [EngineeringOrderController::class, 'edit'])->name('engineering-orders.edit');
        Route::put('engineering-orders/{id}', [EngineeringOrderController::class, 'update'])->name('engineering-orders.update');
        Route::delete('engineering-orders/{id}', [EngineeringOrderController::class, 'destroy'])->name('engineering-orders.destroy');
    });
});

// === Group admin khusus ===
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::patch('users/{id}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggleActive');
    Route::get('users/{id}/detail', [UserController::class, 'detail'])->name('users.detail');
});
Route::prefix('admin')->middleware(['auth','role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});
use App\Http\Controllers\Manajemen\PelangganController;

Route::prefix('manajemen')->middleware(['auth', 'role:manajemen'])->group(function () {
    Route::resource('pelanggan', PelangganController::class);
});
Route::prefix('manajemen')->middleware(['auth', 'role:manajemen'])->group(function () {
    // CRUD pelanggan
    Route::resource('pelanggan', PelangganController::class);

    // Tambahan fitur khusus pelanggan
    Route::patch('pelanggan/{id}/toggle-active', [PelangganController::class, 'toggleActive'])->name('pelanggan.toggleActive');
    Route::get('pelanggan/{id}/detail', [PelangganController::class, 'detail'])->name('pelanggan.detail');
});




Route::middleware('auth')->group(function () {
    Route::get('notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::patch('notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
});
Route::get('notifications', [NotificationController::class, 'index'])
    ->name('notifications.index')
    ->middleware('auth');

Route::get('/aircraft/{id}/report', [AircraftProgramController::class, 'downloadReport'])->name('aircraft.report');

use App\Http\Controllers\WorkPackageController;

Route::prefix('work-package')->group(function () {
    // Form create summary untuk program tertentu
    Route::get('{program}/create', [WorkPackageController::class, 'create'])
        ->name('work-package.create');

    // Simpan summary baru
    Route::post('{program}/store', [WorkPackageController::class, 'store'])
        ->name('work-package.store');

    // Tampilkan summary yang sudah dibuat
    Route::get('{id}', [WorkPackageController::class, 'show'])
        ->name('work-package.show');

    // Download summary ke PDF
    Route::get('{id}/download', [WorkPackageController::class, 'downloadPdf'])
        ->name('work-package.download');
});


Route::get('work-package/{program}/download', [WorkPackageController::class, 'downloadPdf'])
    ->name('work-package.download');

Route::post('work-package/{program}/ajax-update', [WorkPackageController::class, 'ajaxUpdate'])
    ->name('work-package.ajax-update');


// Download PDF summary
Route::get('/work-package/{summary}/download', [App\Http\Controllers\WorkPackageController::class, 'downloadPdf'])
    ->name('work-package.download');


Route::get('/work-package/{program}/summary', [WorkPackageController::class, 'summaryPelanggan'])
    ->name('work-package.summary');


// Audit page
Route::get('audit', function () {
    return view('pelanggan.audit.index');
})->name('audit');

use App\Models\Info;

Route::get('info', function () {
    $infos = Info::latest()->paginate(9);
    return view('pelanggan.info.index', compact('infos'));
})->name('info');



require __DIR__ . '/auth.php';
