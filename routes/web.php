<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\MyReservationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\TypeController;
use App\Http\Middleware\SetLocaleFromUser;
use App\Http\Controllers\TheatreController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Admin\AdminRepresentationController;

/*
|--------------------------------------------------------------------------
| Routes home
|--------------------------------------------------------------------------
*/
Route::get('/', HomeController::class)->name('home');

/*
|--------------------------------------------------------------------------
| Routes dashboard
|--------------------------------------------------------------------------
*/
Route::post('/reviews', 'App\Http\Controllers\ReviewController@store')->name('reviews.store');
Route::get('/schedule/{date?}', ScheduleController::class)
    ->name('schedule.index');

Route::get('/theatre', [TheatreController::class, 'index'])->name('theatre.index');
Route::get('/theatre/{id}', [TheatreController::class, 'show'])
    ->where('id', '[0-9]+')->name('theatre.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
/*
|--------------------------------------------------------------------------
| Routes Feeds
|--------------------------------------------------------------------------
*/
Route::feeds();
/*
|--------------------------------------------------------------------------
| Routes Footer
|--------------------------------------------------------------------------
*/
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/about', 'about')->name('about');
/*
|--------------------------------------------------------------------------
| Langue Routes
|--------------------------------------------------------------------------
*/
Route::prefix('lang')->middleware([SetLocaleFromUser::class])->group(function () {
    Route::get('/{lang?}', [LocaleController::class, 'setLocale'])->name('locale.set');
});
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/*
|--------------------------------------------------------------------------
| Artist Routes
|--------------------------------------------------------------------------
*/
Route::get('/artist', [ArtistController::class, 'index'])->name('artist.index');
Route::get('/artist/{id}', [ArtistController::class, 'show'])
    ->where('id', '[0-9]+')->name('artist.show');
Route::get('/artist/edit/{id}', [ArtistController::class, 'edit'])
    ->where('id', '[0-9]+')->name('artist.edit');
Route::put('/artist/{id}', [ArtistController::class, 'update'])
    ->where('id', '[0-9]+')->name('artist.update');
Route::delete('/artist/{id}', [ArtistController::class, 'destroy'])
    ->where('id', '[0-9]+')->name('artist.delete');
Route::get('/artist/create', [ArtistController::class, 'create'])->name('artist.create');
Route::post('/artist', [ArtistController::class, 'store'])->name('artist.store');

/*
|--------------------------------------------------------------------------
| Type Routes
|--------------------------------------------------------------------------
*/
Route::get('/type', [TypeController::class, 'index'])->name('type.index');
Route::get('/type/{id}', [TypeController::class, 'show'])
    ->where('id', '[0-9]+')->name('type.show');
/*
|--------------------------------------------------------------------------
| Locality Routes
|--------------------------------------------------------------------------
*/
Route::get('/locality', [LocalityController::class, 'index'])->name('locality.index');
Route::get('/locality/{id}', [LocalityController::class, 'show'])
    ->where('id', '[0-9]+')->name('locality.show');
/*
|--------------------------------------------------------------------------
| Role Routes
|--------------------------------------------------------------------------
*/
Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::get('/role/{id}', [RoleController::class, 'show'])
    ->where('id', '[0-9]+')->name('role.show');
/*
|--------------------------------------------------------------------------
| Representation Routes
|--------------------------------------------------------------------------
*/
Route::get('/representation/{id}', [RepresentationController::class, 'show'])->where('id', '[0-9]+')->name('representation.show');
    /*
    |--------------------------------------------------------------------------
    | Show Routes
    |--------------------------------------------------------------------------
    */
Route::get('/show', [ShowController::class, 'index'])->name('show.index');
Route::get('/show/{id}-{slug}', [ShowController::class, 'show'])
    ->where(['id' => '[0-9]+', 'slug' => '[a-z0-9-]+'])
    ->name('show.show');
Route::get('/show/clear-search', [ShowController::class, 'clear'])->name('show.clear');

    /*
    |--------------------------------------------------------------------------
    | Reservation payement Routes
    |--------------------------------------------------------------------------
    */
Route::middleware('auth')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Reservation payement Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/reservation/cart', [ReservationController::class, 'cart'])->name('reservation.cart');
    // remove un element du panier
    Route::delete('/reservation/cart/remove/{id}', [ReservationController::class, 'remove'])->name('reservation.cart.remove');
    // remove all
    Route::delete('/reservation/cart/removeall', [ReservationController::class, 'removeall'])->name('reservation.cart.removeall');
    // checkout dans la vue representation
    Route::post('/create-payment-checkout', [ReservationController::class, 'checkout'])->name('create-payment-checkout');
    // page reservation
    Route::get('/representation/{id}/booking', [RepresentationController::class, 'booking'])->where('id', '[0-9]+')->name('representation.booking');
    // confirmation
    Route::get('/reservation/{id}/confirmation', [ReservationController::class, 'confirmation'])->where('id', '[0-9]+')->name('reservation.confirmation');
    // cancel
    Route::get('/reservation/{id}/cancel', [ReservationController::class, 'cancel'])->where('id', '[0-9]+')->name('reservation.cancel');
    // payement de tout le panier
    Route::post('/reservation/pay-all', [ReservationController::class, 'payCart'])->name('reservation.payall');
});

Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | My Reservation Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/my-reservations', [MyReservationController::class, 'index'])->name('my-reservations.index');
    Route::get('/my-reservations/{id}', [MyReservationController::class, 'show'])->name('my-reservations.show');
    Route::post('/my-reservations/{id}/cancel', [MyReservationController::class, 'cancel'])->name('my-reservations.cancel');
    Route::get('/my-reservations/{id}/download-invoice', [MyReservationController::class, 'downloadStripeInvoice'])->name('my-reservations.download-invoice');
});

Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/admin', AdminController::class)->name('admin.index');
    Route::delete('/admin/show/{id}', [ShowController::class, 'destroy'])->where('id', '[0-9]+')->name('show.destroy');
    Route::get('/admin/show/edit/{id}', [ShowController::class, 'edit'])->where('id', '[0-9]+')->name('show.edit');
    Route::put('/admin/show/{id}', [ShowController::class, 'update'])->where('id', '[0-9]+')->name('show.update');
    Route::get('/admin/show/create', [ShowController::class, 'create'])->name('show.create');
    Route::post('/admin/show', [ShowController::class, 'store'])->name('show.store');

    Route::get('/admin/artist', [ArtistController::class, 'index'])->name('admin.artist.index');
    Route::get('/admin/artist/create', [ArtistController::class, 'create'])->name('admin.artist.create');
    Route::post('/admin/artist', [ArtistController::class, 'store'])->name('artist.store');
    Route::get('/admin/artist/{id}', [ArtistController::class, 'show'])->where('id', '[0-9]+')->name('artist.show');
    Route::get('/admin/artist/edit/{id}', [ArtistController::class, 'edit'])->where('id', '[0-9]+')->name('admin.artist.edit');
    Route::put('/admin/artist/{id}', [ArtistController::class, 'update'])->where('id', '[0-9]+')->name('admin.artist.update');
    Route::delete('/admin/artist/{id}', [ArtistController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.artist.destroy');

    Route::get('/admin/user', [AdminController::class, 'index'])->name('admin.user.index');

    Route::get('/admin/representation', [AdminRepresentationController::class, 'index'])->name('admin.representation.index');
    Route::get('admin/representation/{id}', [AdminRepresentationController::class, 'show'])
        ->where('id', '[0-9]+')->name('admin/representation.show');
    Route::get('/admin/representation/create', [AdminRepresentationController::class, 'create'])->name('admin.representation.create');
    Route::post('/admin/representation', [AdminRepresentationController::class, 'store'])->name('admin.representation.store');
    Route::get('/admin/representation/edit/{id}', [AdminRepresentationController::class, 'edit'])
        ->where('id', '[0-9]+')->name('admin.representation.edit');
    Route::put('/admin/representation/{id}', [AdminRepresentationController::class, 'update'])
        ->where('id', '[0-9]+')->name('admin.representation.update');
    Route::delete('/admin/representation/{id}', [AdminRepresentationController::class, 'destroy'])
        ->where('id', '[0-9]+')->name('admin.representation.destroy');
    /*
    |--------------------------------------------------------------------------
    | Export & Import Routes
    |--------------------------------------------------------------------------
    */
    Route::post('/artists-import', [ArtistController::class, 'import'])->name('artists-import');
    Route::get('/artists-export', [ArtistController::class, 'export'])->name('artists-export');

});

require __DIR__ . '/auth.php';
