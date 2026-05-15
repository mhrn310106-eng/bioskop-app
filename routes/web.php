<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\StudioController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\BookingUserController;

// ── Redirect ke login
Route::get('/', fn() => redirect('/login'));

// ── AUTH (tanpa middleware)
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// ── ADMIN ROUTES
    Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index']);

    // CRUD Film
    Route::resource('film', FilmController::class);

    // CRUD Studio
    Route::resource('studio', StudioController::class);

    // CRUD Jadwal
    Route::resource('jadwal', JadwalController::class);

    // Manajemen Booking
    Route::get('/booking',             [BookingAdminController::class, 'index']);
    Route::get('/booking/{id}/confirm', [BookingAdminController::class, 'confirm']);
    Route::get('/booking/{id}/cancel',  [BookingAdminController::class, 'cancel']);
    Route::get('/booking/{id}/hapus',   [BookingAdminController::class, 'hapus']);

    // Manajemen User
    Route::get('/users',              [UserAdminController::class, 'index']);
    Route::get('/users/create',       [UserAdminController::class, 'create']);
    Route::post('/users/store',       [UserAdminController::class, 'store']);
    Route::get('/users/edit/{id}',    [UserAdminController::class, 'edit']);
    Route::post('/users/update/{id}', [UserAdminController::class, 'update']);
    Route::get('/users/delete/{id}',  [UserAdminController::class, 'delete']);
    Route::get('/users/reset/{id}',   [UserAdminController::class, 'reset']);

    // Verifikasi pembayaran
    Route::get('/booking/{id}/verifikasi', [BookingAdminController::class, 'verifikasi']);

    Route::get('/booking/export/excel', [BookingAdminController::class, 'exportExcel']);
    Route::get('/booking/export/pdf',   [BookingAdminController::class, 'exportPdf']);
});

// ── USER ROUTES
    Route::prefix('user')->middleware('user')->group(function () {
    Route::get('/dashboard',              [DashboardUserController::class, 'index']);
    Route::get('/film',                   [DashboardUserController::class, 'film']);
    Route::get('/jadwal/{film_id}',        [DashboardUserController::class, 'jadwal']);

    // Booking
    Route::get('/booking/{jadwal_id}',     [BookingUserController::class, 'create']);
    Route::post('/booking/{jadwal_id}',    [BookingUserController::class, 'store']);
    Route::get('/booking/detail/{id}',     [BookingUserController::class, 'detail']);
    Route::get('/booking/cancel/{id}',     [BookingUserController::class, 'cancel']);
    Route::get('/riwayat',                 [BookingUserController::class, 'riwayat']);
    Route::get('/profil',                  [DashboardUserController::class, 'profil']);
    Route::post('/profil/update',          [DashboardUserController::class, 'updateProfil']);
    Route::post('/profil/update-password', [DashboardUserController::class, 'updatePassword']);
    
    // Pembayaran
    Route::get('/booking/bayar/{id}',   [BookingUserController::class, 'bayar']);
    Route::post('/booking/bayar/{id}',  [BookingUserController::class, 'uploadBukti']);

    Route::get('/booking/cetak/{id}', [BookingUserController::class, 'cetakPdf']);
    
});
