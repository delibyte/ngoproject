<?php

use App\Http\Controllers\Administrator\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonationTypeController;
use App\Http\Controllers\ExternalNotificationController;
use App\Http\Controllers\PublicityEventController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\WarehouseController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsCoordinator;
use App\Http\Middleware\EnsureUserIsDonor;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('register', [RegistrationController::class, 'create'])->middleware('guest')->name('register');
Route::post('register', [RegistrationController::class, 'store'])->middleware('guest');
Route::get('login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('dashboard', function() {
    if ( Auth::user()->hasRole('administrator') )
    {
        return view('dashboards.admin');
    } else
    {
        return view('dashboards.generic');
    }
})->middleware('auth');

Route::prefix('admin')->group(function () {
    Route::middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::get('userSearch', [UserController::class, 'searchUsers'])->name('admin.usersearch'); // TODO Move to Admin/UserController
        Route::resource('areas', AreaController::class)->except('show');
        Route::resource('roles', RoleController::class)->only(['index', 'edit', 'update']);
        Route::resource('donations/types', DonationTypeController::class);
        Route::resource('notifications', ExternalNotificationController::class)->except(['update', 'destroy']);
        Route::resource('events', PublicityEventController::class);
        Route::resource('warehouses', WarehouseController::class)->except('edit');
    });
});

Route::prefix('coordinator')->group(function () {
    Route::middleware(EnsureUserIsCoordinator::class)->group(function () {
        Route::get('warehouses', [WarehouseController::class, 'index']);
        Route::get('warehouses/{warehouse}', [WarehouseController::class, 'show'])->name('warehouses.show.coordinator');
        Route::resource('shipments', ShipmentController::class);
    });
});

Route::middleware(EnsureUserIsDonor::class)->group(function () {
    Route::get('donations/donate', [DonationController::class, 'create'])->name('donations.create');
    Route::resource('donations', DonationController::class)->except('create');
});
