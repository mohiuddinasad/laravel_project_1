<?php

use App\Http\Controllers\Backend\MyProfile\MyProfileController;
use App\Http\Controllers\Backend\RolePermission\RolePermissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// backend routes
Route::prefix('dashboard/')->name('dashboard.')->middleware(['auth', 'verified'])->group(function () {
    // My profile routes
    Route::get('my-profile', [MyProfileController::class, 'profile_view'])->name('my.profile');
    Route::post('my-profile-info', [MyProfileController::class, 'profile_info'])->name('my.profile.info');
    Route::post('my-profile-image', [MyProfileController::class, 'profile_image'])->name('my.profile.image');
    Route::post('my-profile-pass', [MyProfileController::class, 'profile_pass'])->name('my.profile.pass');

    // Role and permission routes
    Route::prefix('role-permission/')->middleware('can:delete')->name('rolePermission.')->group(function () {
        Route::get('create-user', [RolePermissionController::class, 'createUser'])->name('create.user');
        Route::post('create-user', [RolePermissionController::class, 'userStore'])->name('user.store');
        Route::get('user-list', [RolePermissionController::class, 'userList'])->name('user.list');
        Route::get('user-delete/{id}', [RolePermissionController::class, 'userdelete'])->name('user.delete');
        Route::get('edit-user/{id}', [RolePermissionController::class, 'useredit'])->name('user.edit');
        Route::put('update-user/{id}', [RolePermissionController::class, 'userUpdate'])->name('user.update');
        Route::get('create-role', [RolePermissionController::class, 'createRole'])->name('create.role');
        Route::post('create-role', [RolePermissionController::class, 'createRoleStore'])->name('create.role.store');
        Route::get('role-list/{id}', [RolePermissionController::class, 'roleList'])->name('role.list');
        Route::post('role-list}', [RolePermissionController::class, 'roleListStore'])->name('role.list.store');
        Route::get('all-roles', [RolePermissionController::class, 'allRoles'])->name('all.roles');
        Route::get('permissions/{id}', [RolePermissionController::class,'permissions'])->name('permissions');
        Route::post('permissions', [RolePermissionController::class,'permissionsStore'])->name('permissions.store');
    });
});

// frontend routes

require __DIR__ . '/auth.php';