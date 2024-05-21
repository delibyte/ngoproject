<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonationTypeController;

use App\Http\Middleware\EnsureUserIsAdmin;
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

Route::resource('admin/areas', AreaController::class)->middleware(EnsureUserIsAdmin::class);
Route::resource('admin/roles', RoleController::class)->middleware(EnsureUserIsAdmin::class);
Route::resource('admin/donations/types', DonationTypeController::class)->middleware(EnsureUserIsAdmin::class);
Route::resource('donations', DonationController::class)->middleware(EnsureUserIsDonor::class);
