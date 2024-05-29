<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;


use App\Http\Controllers\Administrator\UserController as AdministratorUserController;
use App\Http\Controllers\Administrator\VolunteerController as AdministratorVolunteerController;
use App\Http\Controllers\Administrator\IndigentController as AdministratorIndigentController;
use App\Http\Controllers\Administrator\DonationController as AdministratorDonationController;

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
        Route::get('userSearch', [AdministratorUserController::class, 'searchUsers'])->name('admin.usersearch');
        Route::resource('areas', AreaController::class)->except('show');
        Route::resource('roles', RoleController::class)->only(['index', 'edit', 'update']);
        Route::resource('donations/types', DonationTypeController::class);
        Route::resource('notifications', ExternalNotificationController::class)->except(['update', 'destroy']);
        Route::resource('events', PublicityEventController::class);
        Route::resource('warehouses', WarehouseController::class)->except('edit');
        Route::resource('volunteers', AdministratorVolunteerController::class)->except(['show', 'create']);
        Route::get('volunteers/applications', [AdministratorVolunteerController::class, 'applications' ])->name('volunteers.applications');
        Route::resource('indigents', AdministratorIndigentController::class)->except(['show', 'create']);
        Route::get('indigents/applications', [AdministratorIndigentController::class, 'applications' ])->name('indigents.applications');
    });
});

Route::prefix('coordinator')->group(function () {
    Route::middleware(EnsureUserIsCoordinator::class)->group(function () {
        Route::get('warehouses', [WarehouseController::class, 'index']);
        Route::get('warehouses/{warehouse}', [WarehouseController::class, 'show'])->name('warehouses.show.coordinator');
        Route::resource('shipments', ShipmentController::class)->except(['store', 'edit']);
        Route::resource('donations', AdministratorDonationController::class)->name('index', 'coordinator.donations.index')
                                                                            ->name('edit', 'coordinator.donations.edit')
                                                                            ->name('store', 'coordinator.donations.store')
                                                                            ->name('update', 'coordinator.donations.update')
                                                                            ->name('destroy', 'coordinator.donations.destroy')
                                                                            ->except(['show', 'create']);
        Route::get('donations/applications', [AdministratorDonationController::class, 'applications'])->name('coordinator.donations.applications');
    });
});

Route::middleware(EnsureUserIsDonor::class)->group(function () {
    Route::get('donations/donate', [DonationController::class, 'create'])->name('donations.create');
    Route::resource('donations', DonationController::class)->except('create');
});
