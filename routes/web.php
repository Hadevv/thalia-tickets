<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RepresentationController;
use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\ReservationController;

use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
| Location Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Representation Routes
|--------------------------------------------------------------------------
*/
Route::get('/representation', [RepresentationController::class, 'index'])->name('representation.index');
Route::get('/representation/{id}', [RepresentationController::class, 'show'])
    ->where('id', '[0-9]+')->name('representation.show');
/*
|--------------------------------------------------------------------------
| Show Routes
|--------------------------------------------------------------------------
*/
Route::get('/show', [ShowController::class, 'index'])->name('show.index');
Route::get('/show/{id}', [ShowController::class, 'show'])
    ->where('id', '[0-9]+')->name('show.show');
Route::get('/show/search', [ShowController::class, 'search'])->name('show.search');

Route::post('/create-payment-checkout', [ReservationController::class, 'store'])->name('create-payment-checkout');
Route::get('/representation/{id}/booking', [RepresentationController::class, 'booking'])->where('id', '[0-9]+')->name('representation.booking');
Route::get('/reservation/{id}/confirmation', [ReservationController::class, 'confirmation'])->where('id', '[0-9]+')->name('reservation.confirmation');
Route::get('/reservation/{id}/cancel', [ReservationController::class, 'cancel'])->where('id', '[0-9]+')->name('reservation.cancel');
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin', AdminController::class)->name('admin.index');
Route::delete('/admin/show/{id}', [ShowController::class,'destroy'])->where('id', '[0-9]+')->name('show.destroy');
Route::get('/admin/show/edit/{id}', [ShowController::class,'edit'])->where('id', '[0-9]+')->name('show.edit');
Route::put('/admin/show/{id}', [ShowController::class,'update'])->where('id', '[0-9]+')->name('show.update');
Route::get('/admin/show/create', [ShowController::class,'create'])->name('show.create');
Route::post('/admin/show', [ShowController::class,'store'])->name('show.store');

Route::get('/admin/artist', [ArtistController::class,'index'])->name('admin.artist.index');
Route::get('/admin/artist/create', [ArtistController::class,'create'])->name('artist.create');
Route::post('/admin/artist', [ArtistController::class,'store'])->name('artist.store');
Route::get('/admin/artist/{id}', [ArtistController::class,'show'])->where('id', '[0-9]+')->name('artist.show');
Route::get('/admin/artist/edit/{id}', [ArtistController::class,'edit'])->where('id', '[0-9]+')->name('artist.edit');
Route::put('/admin/artist/{id}', [ArtistController::class,'update'])->where('id', '[0-9]+')->name('artist.update');


Route::delete('/admin/artist/{id}', [ArtistController::class,'destroy'])->where('id', '[0-9]+')->name('artist.destroy');





require __DIR__ . '/auth.php';
