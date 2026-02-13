<?php

use App\Http\Controllers\Admin\AdminKamarController;
use App\Http\Controllers\Admin\AdminFasilitasController;
use App\Http\Controllers\Admin\AdminGaleriController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKosController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminWebsiteProfileController;

// User Controller
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\KamarController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\GaleriController;
use App\Http\Controllers\User\KosController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\TransaksiController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Middleware\AdminMiddleware;


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


// Route::prefix('user')->name('user.')->group(function () {
Route::name('user.')->group(function () {

    Route::get('/', [BerandaController::class, 'index'])->name('beranda');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog/{blog}', [BlogController::class, 'show'])
        ->name('blog.show');
    Route::post('/blog/{blog}/like', [BlogController::class, 'toggleLike'])
        ->name('blog.like')
        ->middleware('auth');

    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

    Route::get('/kos', [KosController::class, 'index'])->name('kos.index');


    Route::post('/kos/{kos}/like', [KosController::class, 'like'])
        ->name('kos.like')
        ->middleware('auth');


    Route::get('/kos/{kos}', [KosController::class, 'show'])->name('kos.show');





    Route::get('/kamar/{kamar}', [KamarController::class, 'show'])
        ->name('kamar.show');

    Route::post('/kamar/{kamar}/review', [ReviewController::class, 'store'])
        ->name('reviews.store');

    Route::get('/reviews', [ReviewController::class, 'myReviews'])
        ->name('reviews.mine');

    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])
        ->name('reviews.edit');

    Route::put('/reviews/{review}', [ReviewController::class, 'update'])
        ->name('reviews.update');

    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
        ->name('reviews.destroy');

    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar');
    Route::get('/kamar/detail', [KamarController::class, 'detail'])
        ->name('kamar.detail');

    // BOOKING
    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking');

    Route::get('/booking/{kamar}', [BookingController::class, 'create'])
        ->name('booking.create');

    Route::get('/booking/{booking}/payment', [BookingController::class, 'payment'])
        ->name('booking.payment');

    Route::post('/booking/{kamar}', [BookingController::class, 'store'])
        ->name('booking.store');

    Route::get('/booking/success/{booking}', [BookingController::class, 'success'])
        ->name('booking.success');


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


Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', AdminMiddleware::class])
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

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

        Route::resource('booking', AdminBookingController::class)
            ->only(['index', 'show', 'update', 'destroy']);
        Route::patch(
            'booking/{booking}/status',
            [AdminBookingController::class, 'updateStatus']
        )->name('booking.updateStatus');

        Route::resource('review', AdminReviewController::class)
            ->only(['index', 'destroy']);


        Route::put('/settings', [AdminSettingController::class, 'update'])
            ->name('settings.update');
        // });

        Route::get('/reviews', [AdminReviewController::class, 'index'])
            ->name('reviews.index');

        Route::patch('/admin/reviews/{review}/status', [AdminReviewController::class, 'updateStatus'])
            ->name('reviews.status');

        Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])
            ->name('reviews.destroy');

        Route::get('/settings', [AdminSettingController::class, 'index'])
            ->name('settings.index');

        Route::put('/settings', [AdminSettingController::class, 'update'])
            ->name('settings.update');

       Route::get('/website-profile', [AdminWebsiteProfileController::class, 'index'])
        ->name('website-profile.index');

    Route::get('/website-profile/edit', [AdminWebsiteProfileController::class, 'edit'])
        ->name('website-profile.edit');

    Route::put('/website-profile/update', [AdminWebsiteProfileController::class, 'update'])
        ->name('website-profile.update');
    });
