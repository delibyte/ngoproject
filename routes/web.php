<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;

use App\Http\Controllers\Administrator\UserController as AdministratorUserController;
use App\Http\Controllers\Administrator\VolunteerController as AdministratorVolunteerController;
use App\Http\Controllers\Administrator\IndigentController as AdministratorIndigentController;
use App\Http\Controllers\Administrator\DonationController as AdministratorDonationController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BankLogController;
use App\Http\Controllers\Dashboard\AdminController as AdminDashboardController;
use App\Http\Controllers\Dashboard\GatewayController;
use App\Http\Controllers\Dashboard\VolunteerController as VolunteerDashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonationTypeController;
use App\Http\Controllers\ExternalNotificationController;
use App\Http\Controllers\PublicityEventController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\UserController as ProfileController;
use App\Http\Controllers\WarehouseController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsCoordinator;
use App\Http\Middleware\EnsureUserIsDonor;
use App\Http\Middleware\EnsureUserIsVolunteer;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('register', [RegistrationController::class, 'create'])->middleware('guest')->name('register');
Route::post('register', [RegistrationController::class, 'store'])->middleware('guest');
Route::get('login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('dashboard', [AdminDashboardController::class, 'index'])->middleware(EnsureUserIsAdmin::class);
Route::get('gateway', [GatewayController::class, 'index'])->middleware('auth')->name('gateway');

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'show')->name('profile.show');
        Route::get('profile/edit', 'edit')->name('profile.edit');
        Route::patch('profile', 'update')->name('profile.update');
        Route::delete('profile', 'destroy')->name('profile.destroy');
    });
});

Route::prefix('admin')->group(function () {
    Route::middleware(EnsureUserIsAdmin::class)->group(function () {
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
        Route::resource('users', AdministratorUserController::class)->only(['index', 'edit', 'update', 'destroy']);
    });
});

Route::prefix('coordinator')->group(function () {
    Route::middleware(EnsureUserIsCoordinator::class)->group(function () {
        Route::get('userSearch', [AdministratorUserController::class, 'searchUsers'])->name('admin.usersearch');
        Route::get('warehouses', [WarehouseController::class, 'index']);
        Route::get('warehouses/{warehouse}', [WarehouseController::class, 'show'])->name('warehouses.show.coordinator');
        Route::resource('shipments', ShipmentController::class)->except(['edit']);
        Route::resource('donations', AdministratorDonationController::class)->name('index', 'coordinator.donations.index')
                                                                            ->name('edit', 'coordinator.donations.edit')
                                                                            ->name('store', 'coordinator.donations.store')
                                                                            ->name('update', 'coordinator.donations.update')
                                                                            ->name('destroy', 'coordinator.donations.destroy')
                                                                            ->except(['show', 'create']);
        Route::get('donations/applications', [AdministratorDonationController::class, 'applications'])->name('coordinator.donations.applications');
        Route::resource('banklogs', BankLogController::class)->only(['index', 'show']);
    });
});

Route::middleware(EnsureUserIsDonor::class)->group(function () {
    Route::get('donations/donate', [DonationController::class, 'create'])->name('donations.create');
    Route::resource('donations', DonationController::class)->except('create');
});

Route::prefix('volunteer')->group(function () {
    Route::middleware(EnsureUserIsVolunteer::class)->group(function () {
        Route::resource('shipments', VolunteerDashboardController::class)
                                                                        ->name('index', 'volunteer.dashboard.index')
                                                                        ->name('show', 'volunteer.dashboard.shipment.show')
                                                                        ->name('update', 'volunteer.dashboard.shipment.update')
                                                                        ->only(['index', 'show', 'update']);
    });
});
