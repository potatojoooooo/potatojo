<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckInsController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/accept-friend-request', [FriendsController::class, 'acceptFriendRequest'])->name('accept-friend-request');
Route::post('/store-coordinates', [DashboardController::class, 'storeCoordinates']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/update-location-sharing', [ProfileController::class, 'updateLocationSharing'])
        ->name('update-location-sharing');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkins', [CheckInsController::class, 'index'])->name('checkins.index');
    Route::get('/checkins/create', [CheckInsController::class, 'create'])->name('checkins.create');
    Route::get('/checkins/{id}/edit', [CheckInsController::class, 'edit'])->name('checkins.edit');
    Route::put('/checkins/{id}', [CheckInsController::class, 'update'])->name('checkins.update');
    Route::post('/checkins', [CheckInsController::class, 'store'])->name('checkins.store');
    Route::delete('/checkins/{id}', [CheckInsController::class, 'destroy'])->name('checkins.destroy');
});


Route::middleware(['auth'])->group(function () {

    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::get('/search', [EventController::class, 'searchEvents'])->name('events.search');
        Route::get('/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/', [EventController::class, 'store'])->name('events.store');
        Route::get('/{event}', [EventController::class, 'show'])->name('events.show');
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    });
});



Route::middleware(['auth'])->group(function () {
    Route::prefix('home')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('home');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
    });
});

// Route::get('/utar', [AdminController::class, 'index'])->name('utar.index');
Route::get('/analysis', [AdminController::class, 'index'])->name('analysis.index');



require __DIR__ . '/auth.php';
