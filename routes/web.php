<?php

use Illuminate\Support\Facades\Route;
use Http\Controllers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     // Artisan::call('conig:clear');
//     // Artisan::call('cache:clear');
//     // Artisan::call('view:clear');
//     Artisan::call('route:clear');
//     dd('clear');
// });
// Route::get('/',[App\Http\Controllers\Admin\AdminController::class,'index'])->name('admin.dashboard');

Route::prefix('admin')->group(function(){
	Route::get('/',[App\Http\Controllers\Admin\AdminController::class,'index'])->name('admin.dashboard');
	Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
	Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');
	Route::get('/forgot-password', [App\Http\Controllers\Auth\AdminLoginController::class, 'showForgotPasswordForm'])->name('admin.forgot-password');
    Route::post('/forgot-password', [App\Http\Controllers\Auth\AdminLoginController::class, 'validateEmail'])->name('admin.forgot-password.submit');
    Route::get('/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

    //Admin Roles & Permissions Route
    Route::middleware('role')->group(function () {
        // export type
        Route::prefix('exportType')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ExportTypeController::class, 'index'])->name('admin.exportType.index');
            Route::get('/create', [App\Http\Controllers\Admin\ExportTypeController::class, 'create'])->name('admin.exportType.create');
            Route::post('/create', [App\Http\Controllers\Admin\ExportTypeController::class, 'store'])->name('admin.exportType.store');
            Route::get('/{id}/edit', [App\Http\Controllers\Admin\ExportTypeController::class, 'edit'])->name('admin.exportType.edit');
            Route::put('/{id}', [App\Http\Controllers\Admin\ExportTypeController::class, 'update'])->name('admin.exportType.update');
            Route::delete('/{id}', [App\Http\Controllers\Admin\ExportTypeController::class, 'destroy'])->name('admin.exportType.destroy');
        });

        //user Type
        Route::prefix('userType')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\UserTypeController::class, 'index'])->name('admin.userType.index');
            Route::get('/create', [App\Http\Controllers\Admin\UserTypeController::class, 'create'])->name('admin.userType.create');
            Route::post('/create', [App\Http\Controllers\Admin\UserTypeController::class, 'store'])->name('admin.userType.store');
            Route::get('/{id}/edit', [App\Http\Controllers\Admin\UserTypeController::class, 'edit'])->name('admin.userType.edit');
            Route::put('/{id}', [App\Http\Controllers\Admin\UserTypeController::class, 'update'])->name('admin.userType.update');
            Route::delete('/{id}', [App\Http\Controllers\Admin\UserTypeController::class, 'destroy'])->name('admin.userType.destroy');
        });

        //deal Type
        Route::prefix('dealType')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\DealTypeController::class, 'index'])->name('admin.dealType.index');
            Route::get('/create', [App\Http\Controllers\Admin\DealTypeController::class, 'create'])->name('admin.dealType.create');
            Route::post('/create', [App\Http\Controllers\Admin\DealTypeController::class, 'store'])->name('admin.dealType.store');
            Route::get('/{id}/edit', [App\Http\Controllers\Admin\DealTypeController::class, 'edit'])->name('admin.dealType.edit');
            Route::put('/{id}', [App\Http\Controllers\Admin\DealTypeController::class, 'update'])->name('admin.dealType.update');
            Route::delete('/{id}', [App\Http\Controllers\Admin\DealTypeController::class, 'destroy'])->name('admin.dealType.destroy');
        });
        // export capacity
        Route::prefix('exportCapacity')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ExportCapacityController::class, 'index'])->name('admin.exportCapacity.index');
            Route::get('/create', [App\Http\Controllers\Admin\ExportCapacityController::class, 'create'])->name('admin.exportCapacity.create');
            Route::post('/create', [App\Http\Controllers\Admin\ExportCapacityController::class, 'store'])->name('admin.exportCapacity.store');
            Route::get('/{id}/edit', [App\Http\Controllers\Admin\ExportCapacityController::class, 'edit'])->name('admin.exportCapacity.edit');
            Route::put('/{id}', [App\Http\Controllers\Admin\ExportCapacityController::class, 'update'])->name('admin.exportCapacity.update');
            Route::delete('/{id}', [App\Http\Controllers\Admin\ExportCapacityController::class, 'destroy'])->name('admin.exportCapacity.destroy');
        });

        // document Master
        Route::prefix('document')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\DocumentController::class, 'index'])->name('admin.document.index');
            Route::get('/create', [App\Http\Controllers\Admin\DocumentController::class, 'create'])->name('admin.document.create');
            Route::post('/create', [App\Http\Controllers\Admin\DocumentController::class, 'store'])->name('admin.document.store');
            Route::get('/{id}/edit', [App\Http\Controllers\Admin\DocumentController::class, 'edit'])->name('admin.document.edit');
            Route::put('/{id}', [App\Http\Controllers\Admin\DocumentController::class, 'update'])->name('admin.document.update');
            Route::delete('/{id}', [App\Http\Controllers\Admin\DocumentController::class, 'destroy'])->name('admin.document.destroy');
        });

        // sub admin
        Route::prefix('sub-admins')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'sub_admins'])->name('admin.sub_admins.index');
            Route::get('/create', [App\Http\Controllers\Admin\AdminController::class, 'create'])->name('admin.sub_admins.create');
            Route::post('/create', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.sub_admins.store');
            Route::get('/{id}/edit', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('admin.sub_admins.edit');
            Route::put('/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('admin.sub_admins.update');
        });

        // Payment Terms
        Route::prefix('paymentTerms')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\PaymentTermsController::class, 'index'])->name('admin.paymentTerms.index');
            Route::get('/create', [App\Http\Controllers\Admin\PaymentTermsController::class, 'create'])->name('admin.paymentTerms.create');
            Route::post('/create', [App\Http\Controllers\Admin\PaymentTermsController::class, 'store'])->name('admin.paymentTerms.store');
            Route::get('/{id}/edit', [App\Http\Controllers\Admin\PaymentTermsController::class, 'edit'])->name('admin.paymentTerms.edit');
            Route::put('/{id}', [App\Http\Controllers\Admin\PaymentTermsController::class, 'update'])->name('admin.paymentTerms.update');
            Route::delete('/{id}', [App\Http\Controllers\Admin\PaymentTermsController::class, 'destroy'])->name('admin.paymentTerms.destroy');
        });

        // Offer Management
        Route::prefix('offers')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\OfferController::class, 'index'])->name('admin.offers.index');
            Route::get('/create', [App\Http\Controllers\Admin\OfferController::class, 'create'])->name('admin.offers.create');
            Route::get('/{id}/view', [App\Http\Controllers\Admin\OfferController::class, 'view'])->name('admin.offers.view');
            Route::get('/changeStatus', [App\Http\Controllers\Admin\OfferController::class, 'changeStatus'])->name('admin.offers.changeStatus');
        });
    });

    Route::post('/submit', [App\Http\Controllers\Admin\AdminController::class, 'submitChat'])->name('admin.orders.submitChat');
});



