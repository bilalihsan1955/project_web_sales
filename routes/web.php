<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BigDataController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\InvalidDataController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\KepalaCabang\DashboardController as KepalaCabangDashboardController;
use App\Http\Controllers\KepalaCabang\LaporanController as KepalaCabangLaporanController;
use App\Http\Controllers\KepalaCabang\UserManagementController as KepalaCabangUserManagementController;
use App\Http\Controllers\Supervisor\DashboardController as SupervisorDashboardController;
use App\Http\Controllers\Supervisor\LaporanController as SupervisorLaporanController;
use App\Http\Controllers\Salesman\DashboardController as SalesmanDashboardController;
use App\Http\Controllers\Salesman\LaporanController as SalesmanLaporanController;
use App\Http\Controllers\Salesman\SavedDataController as SalesmanSavedDataController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login-user', [AuthController::class, 'index'])->name('login'); // Login
Route::post('/login', [AuthController::class, 'login'])->name('login.action');


// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); // Logout

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); // Dashboard

    Route::get('/big-data', [BigDataController::class, 'index'])->name('bigdata'); // Big Data

    Route::get('/invalid-data', [InvalidDataController::class, 'index'])->name('invaliddata'); // Invalid Data

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan'); // Laporan

    Route::get('/user-management', [UserManagementController::class, 'index'])->name('usermanagement'); // user management
});

// Kepala Cabang
Route::middleware(['auth', 'role:kacab'])->prefix('kepala-cabang')->name('kacab.')->group(function () {

    Route::get('/', [KepalaCabangDashboardController::class, 'index'])->name('dashboard'); // Dashboard

    Route::get('/laporan', [KepalaCabangLaporanController::class, 'index'])->name('laporan'); // Laporan

    Route::get('/user-management', [KepalaCabangUserManagementController::class, 'index'])->name('usermanagement'); // user management
});

// Supervisor
Route::middleware(['auth', 'role:supervisor'])->prefix('supervisor')->name('supervisor.')->group(function () {

    Route::get('/', [SupervisorDashboardController::class, 'index'])->name('dashboard'); // Dashboard

    Route::get('/laporan', [SupervisorLaporanController::class, 'index'])->name('laporan'); // Laporan
});

// Salesman
Route::middleware(['auth', 'role:salesman'])->prefix('salesman')->name('salesman.')->group(function () {

    Route::get('/', [SalesmanDashboardController::class, 'index'])->name('dashboard'); // Dashboard

    Route::get('/saved-customer', [SalesmanSavedDataController::class, 'index'])->name('saved-customer'); // Saved Data

    Route::get('/laporan', [SalesmanLaporanController::class, 'index'])->name('laporan'); // Laporan
});


