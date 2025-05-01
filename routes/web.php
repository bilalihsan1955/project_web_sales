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

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); // Logout

    // dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); // Dashboard

    // big data
    Route::get('/big-data', [BigDataController::class, 'index'])->name('bigdata'); //index
    Route::post('/big-data/store', [BigDataController::class, 'store'])->name('bigdata.store'); // create
    Route::get('/customer/{id}', [BigDataController::class, 'show'])->name('customer.show'); //show
    Route::delete('/customer/{id}', [BigDataController::class, 'destroy'])->name('customer.destroy'); // soft delete
    Route::get('/customer/{id}/restore', [BigDataController::class, 'restore'])->name('customer.restore'); //restore (update)

    // invalid
    Route::get('/invalid-data', [InvalidDataController::class, 'index'])->name('invaliddata'); //index
    Route::delete('/customer/{id}', [InvalidDataController::class, 'destroy'])->name('customer.destroy'); //delete

    //laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan'); // Laporan

    //user management
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('usermanagement'); // User Management
    Route::get('/users/{id}', [UserManagementController::class, 'show'])->name('users.show');
    Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user.create');
    Route::post('/users', [UserManagementController::class, 'store'])->name('user.store');
    Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('user.delete');
});

// Kepala Cabang Routes
Route::middleware(['auth', 'role:kepala_cabang'])->prefix('kepala-cabang')->name('kacab.')->group(function () {

    //dashboard
    Route::get('/', [KepalaCabangDashboardController::class, 'index'])->name('dashboard'); // Dashboard

    //laporan
    Route::get('/laporan', [KepalaCabangLaporanController::class, 'index'])->name('laporan'); // Laporan

    //user management
    Route::get('/user-management', [KepalaCabangUserManagementController::class, 'index'])->name('usermanagement'); // user management
    Route::get('/kepalacabang/users/create', [UserManagementController::class, 'create'])->name('kepalacabang.user.create');
    Route::get('/kepalacabang/users/{id}', [UserManagementController::class, 'show'])->name('user.show');
    Route::post('/kepalacabang/users', [UserManagementController::class, 'store'])->name('kepalacabang.user.store');
    Route::delete('/kepalacabang/users/{id}', [UserManagementController::class, 'destroy'])->name('user.destroy');
});

// Supervisor Routes
Route::middleware(['auth', 'role:supervisor'])->prefix('supervisor')->name('supervisor.')->group(function () {

    Route::get('/', [SupervisorDashboardController::class, 'index'])->name('dashboard'); // Dashboard

    Route::get('/laporan', [SupervisorLaporanController::class, 'index'])->name('laporan'); // Laporan
});

// Salesman Routes
Route::middleware(['auth', 'role:salesman'])->prefix('salesman')->name('salesman.')->group(function () {

    Route::get('/', [SalesmanDashboardController::class, 'index'])->name('dashboard'); // Dashboard

    Route::get('/saved-customer', [SalesmanSavedDataController::class, 'index'])->name('saved-customer'); // Saved Data

    Route::get('/laporan', [SalesmanLaporanController::class, 'index'])->name('laporan'); // Laporan
});
