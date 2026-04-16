<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminUserController;

Route::middleware('auth')->group(function () {

    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');

    Route::get('/admin/users/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.users.edit');

    Route::post('/admin/users/update/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');

    Route::post('/admin/users/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.users.delete');

});
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
});
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function () {

    Route::get('/admin', function () {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        return view('admin.dashboard');
    })->name('admin.dashboard');

});

Route::middleware('auth')->group(function () {
   Route::get('/profile', function () {
    return view('profile-custom');
})->middleware('auth');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');

    Route::post('/absensi/masuk', [AbsensiController::class, 'masuk'])
        ->name('absensi.masuk');

    Route::post('/absensi/keluar/{id}', [AbsensiController::class, 'keluar'])
        ->name('absensi.keluar');
});


Route::get('/admin/absensi', function () {
    if (Auth::user()->role != 'admin') abort(403);

    $data = \App\Models\Absensi::with('user')->get();

    return view('admin.absensi', compact('data'));
});
require __DIR__.'/auth.php';
