<?php

use App\Http\Controllers\BAckend\Category\CategoryController;
use App\Http\Controllers\Backend\MyProfile\MyProfileController;
use App\Http\Controllers\Backend\Order\OrderController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\RolePermission\RolePermissionController;
use App\Http\Controllers\Frontend\Cart\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductDetails\DetailsController;
use App\Http\Controllers\Frontend\Shop\ShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

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
    // My profile routes
    Route::get('my-profile', [MyProfileController::class, 'profile_view'])->name('my.profile');
    Route::post('my-profile-info', [MyProfileController::class, 'profile_info'])->name('my.profile.info');
    Route::post('my-profile-image', [MyProfileController::class, 'profile_image'])->name('my.profile.image');
    Route::post('my-profile-pass', [MyProfileController::class, 'profile_pass'])->name('my.profile.pass');

    // Role and permission routes
    Route::prefix('role-permission/')->middleware(['auth', 'verified'])->name('rolePermission.')->group(function () {
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
        Route::get('permissions/{id}', [RolePermissionController::class, 'permissions'])->name('permissions');
        Route::post('permissions', [RolePermissionController::class, 'permissionsStore'])->name('permissions.store');
    });

    // category routes
    Route::prefix('category/')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('category-store', [CategoryController::class, 'categoryStore'])->name('category.store');
        Route::get('category-view', [CategoryController::class, 'categoryView'])->name('category.view');
        Route::get('category-edit/{slug}', [CategoryController::class, 'categoryEdit'])->name('category.edit');
        Route::put('category-update/{slug}', [CategoryController::class, 'categoryUpdate'])->name('category.update');
        Route::get('category-delete/{slug}', [CategoryController::class, 'categoryDelete'])->name('category.delete');

    });

    Route::prefix('product/')->name('product.')->group(function () {
        // Product routes will go here
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('show', [ProductController::class, 'show'])->name('show');
        Route::get('edit/{slug}', [ProductController::class, 'edit'])->name('edit');
        Route::put('update/{slug}', [ProductController::class, 'update'])->name('update');
        Route::get('delete-product/{slug}', [ProductController::class, 'deleteProduct'])->name('delete.product');
        Route::get('image-delete/{id}', [ProductController::class, 'imageDelete'])->name('image.delete');

    });

    // order routes

    Route::prefix('order/')->name('order.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('show/{id}', [OrderController::class, 'show'])->name('show');
        Route::get('/{id}/update-status', [OrderController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/{id}', [OrderController::class, 'destroy'])->name('destroy');
    });
});

// frontend routes
Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // cart route
    Route::get('cart/', [CartController::class, 'cart'])->name('cart');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

    Route::get('add-to-cart/{id}', [HomeController::class, 'addToCart'])->name('add.to.cart');
    Route::get('remove-cart/{id}', [HomeController::class, 'removeCart'])->name('remove.cart');
    Route::get('checkout/', [HomeController::class, 'checkout'])->name('checkout');
    // Changed from POST to GET
    Route::post('/pay', [HomeController::class, 'payIndex'])->name('pay');
    Route::post('/pay-via-ajax', [HomeController::class, 'payViaAjax']);
    Route::get('product-details/{slug}', [DetailsController::class, 'productDetails'])->name('product.details');
    Route::post('/increase/{id}', [DetailsController::class, 'increase'])->name('product.increase');
    Route::post('/decrease/{id}', [DetailsController::class, 'decrease'])->name('product.decrease');
    // shop routes
    Route::get('shop/', [ShopController::class, 'shop'])->name('shop');
    Route::get('categories/{slug}', [ShopController::class, 'categoryWiseProduct'])->name('categories.show');
    Route::get('/products/filter', [ShopController::class, 'filter'])->name('products.filter');

});
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

// Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
// Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
// SSLCOMMERZ END
require __DIR__.'/auth.php';