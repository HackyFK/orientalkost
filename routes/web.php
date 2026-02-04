<?php

use App\Http\Controllers\Admin\{
    AdminDashboardController,
    AdminKosController,
    AdminKamarController,
    AdminFasilitasController,
    AdminBlogController,
    AdminGaleriController,
    AdminBookingController,
    AdminReviewController,
    AdminSettingController
};
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH (BREEZE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
// Route::middleware(['auth', 'is_admin'])
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('kos', AdminKosController::class);
        Route::resource('kamar', AdminKamarController::class);
        Route::resource('fasilitas', AdminFasilitasController::class);
        Route::resource('blog', AdminBlogController::class);
        Route::resource('galeri', AdminGaleriController::class);

        Route::resource('booking', AdminBookingController::class)
            ->only(['index', 'show', 'update', 'destroy']);

        Route::resource('review', AdminReviewController::class)
            ->only(['index', 'destroy']);

        Route::get('setting', [AdminSettingController::class, 'index'])
            ->name('setting.index');

        Route::post('setting', [AdminSettingController::class, 'update'])
            ->name('setting.update');
    // });
