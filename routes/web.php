<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;

use App\Http\Middleware\EnsureUserIsAdmin;

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

Route::get('test', function() {
    return true;
})->middleware(['auth', EnsureUserIsAdmin::class]);
