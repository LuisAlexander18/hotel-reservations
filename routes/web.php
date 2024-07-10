<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\CustomerController;

Route::controller(FrontController::class)->group(function () {
    Route::get('/', 'index')->name('front.index');
});

Route::resource('rooms', RoomController::class)->middleware('auth');
Route::resource('reservations', ReservationController::class)->middleware('auth');
Route::resource('customers', CustomerController::class)->middleware('auth');

Route::post('reservations/change-status/{room}', [ReservationController::class, 'changeStatus'])->name('reservations.changeStatus');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/user', function() {
    return view('aplicacion.back.index');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterUserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterUserController::class, 'register']);

Route::get('reservations/assign/{customer_id}', [ReservationController::class, 'assignRoom'])->name('reservations.assignRoom');
Route::post('reservations/assign', [ReservationController::class, 'storeAssignment'])->name('reservations.storeAssignment');

require __DIR__.'/auth.php';
