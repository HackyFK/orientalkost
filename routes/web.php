<?php

use App\Http\Controllers\Admin\AdminKamarController;
use App\Http\Controllers\Admin\AdminFasilitasController;
use App\Http\Controllers\Admin\AdminGaleriController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKosController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// User Controller
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\KamarController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\GaleriController;
use App\Http\Controllers\User\KosController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\TransaksiController;



/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| AUTH (BREEZE)
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| PUBLIC / USER
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| PUBLIC / USER
|--------------------------------------------------------------------------
*/

Route::name('user.')->group(function () {

    Route::get('/', [BerandaController::class, 'index'])->name('beranda');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog');

    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

    Route::get('/kos', [KosController::class, 'index'])->name('kos');

    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar');
    Route::get('/kamar/detail', [KamarController::class, 'detail'])
        ->name('kamar.detail');


    Route::get('/booking', [BookingController::class, 'index'])->name('booking');

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
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

    Route::resource('blog', AdminBlogController::class);

    Route::post('blog/{blog}/publish', [AdminBlogController::class, 'publish'])
        ->name('blog.publish');

    Route::post('blog/{blog}/unpublish', [AdminBlogController::class, 'unpublish'])
        ->name('blog.unpublish');



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
});
