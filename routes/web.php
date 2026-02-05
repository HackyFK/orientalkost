<?php

use App\Http\Controllers\Admin\AdminKamarController;
use App\Http\Controllers\Admin\AdminFasilitasController;
use App\Http\Controllers\Admin\AdminGaleriController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKosController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\BookingController;
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

require __DIR__ . '/auth.php';

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

Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('kos', AdminKosController::class);

    Route::delete(
        'kos-image/{image}',
        [AdminKosController::class, 'deleteImage']
    )->name('kos.image.delete');

    Route::patch('kos-image/{image}/primary', [AdminKosController::class, 'setPrimaryImage'])->name('kos.image.primary');

    Route::resource('kamar', AdminKamarController::class);

    Route::resource('fasilitas', AdminFasilitasController::class);
    
});

Route::resource('blog', AdminBlogController::class);
Route::resource('galeri', AdminGaleriController::class);

Route::resource('booking', BookingController::class)
    ->only(['index', 'show', 'update', 'destroy']);

Route::resource('review', AdminReviewController::class)
    ->only(['index', 'destroy']);

Route::get('setting', [AdminSettingController::class, 'index'])
    ->name('setting.index');

Route::post('setting', [AdminSettingController::class, 'update'])
    ->name('setting.update');
    // });
