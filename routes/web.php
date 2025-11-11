<?php

use App\Http\Controllers\Backend\MyProfile\MyProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// backend routes
Route::prefix('dashboard/')->name('dashboard.')->middleware(['auth', 'verified'])->group(function () {
    // Add backend routes here
    Route::get('my-profile', [MyProfileController::class, 'profile_view'])->name('my.profile');
    Route::post('my-profile-info', [MyProfileController::class, 'profile_info'])->name('my.profile.info');
    Route::post('my-profile-image', [MyProfileController::class, 'profile_image'])->name('my.profile.image');
    Route::post('my-profile-pass', [MyProfileController::class, 'profile_pass'])->name('my.profile.pass');
});

// frontend routes

require __DIR__.'/auth.php';
