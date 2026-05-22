<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| SUPPLIER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:supplier'])->group(function () {

    Route::get(
        '/dashboard-supplier',
        [SupplierController::class, 'dashboard']
    );

    Route::get(
        '/donate',
        [SupplierController::class, 'donatePage']
    );

    Route::post(
        '/donate',
        [SupplierController::class, 'storeDonation']
    );

    Route::get(
        '/notifications',
        [SupplierController::class, 'notifications']
    );

    Route::get(
        '/history',
        [SupplierController::class, 'history']
    );

    Route::get(
        '/settings',
        [SupplierController::class, 'settings']
    );

    Route::post(
        '/settings/update',
        [SupplierController::class, 'updateSettings']
    );

    Route::post(
        '/settings/password',
        [SupplierController::class, 'updatePassword']
    );

    Route::post(
        '/approve-donation/{id}',
        [SupplierController::class, 'approveDonation']
    );

    Route::post(
        '/send-distribution/{id}',
        [SupplierController::class, 'sendDistribution']
    );
});

/*
|--------------------------------------------------------------------------
| COMMUNITY
|--------------------------------------------------------------------------
*/

Route::middleware(['role:community'])->group(function () {

    Route::get(
        '/dashboard-community',
        [CommunityController::class, 'dashboard']
    );

    Route::get(
        '/available-donations',
        [CommunityController::class, 'donations']
    );

    Route::get(
        '/community-notifications',
        [CommunityController::class, 'notifications']
    );

    Route::get(
        '/distribution-history',
        [CommunityController::class, 'history']
    );

    Route::post(
        '/claim-donation/{id}',
        [CommunityController::class, 'claimDonation']
    );

    Route::post(
        '/complete-donation/{id}',
        [CommunityController::class, 'completeDonation']
    );

    Route::get(
        '/community-settings',
        [CommunityController::class, 'settings']
    );

    Route::post(
        '/community-settings/update',
        [CommunityController::class, 'updateSettings']
    );

    Route::post(
        '/community-settings/password',
        [CommunityController::class, 'updatePassword']
    );
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['role:superadmin'])->group(function () {

    Route::get(
        '/dashboard-admin',
        [AdminController::class, 'dashboard']
    );
});
