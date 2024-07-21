<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryAssignmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;

Route::controller(FrontController::class)->group(function () {
    Route::get('/', 'index')->name('front.index');
});

Route::resource('rooms', RoomController::class)->middleware('auth');
Route::resource('reservations', ReservationController::class)->middleware('auth');
Route::resource('customers', CustomerController::class)->middleware('auth');
Route::resource('inventories', InventoryController::class)->middleware('auth');
Route::resource('inventory-assignments', InventoryAssignmentController::class);
Route::post('/payments/process', [PaymentController::class, 'process'])->name('payments.process');

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
    Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('payments/store', [PaymentController::class, 'store'])->name('payments.store');

    // Rutas para los reportes
    Route::prefix('admin/reports')->name('admin.reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/payments', [ReportController::class, 'generatePaymentsReport'])->name('payments');
        Route::get('/reservations', [ReportController::class, 'generateReservationsReport'])->name('reservations');
        Route::get('/customers', [ReportController::class, 'generateCustomersReport'])->name('customers');
        Route::get('/rooms', [ReportController::class, 'generateRoomsReport'])->name('rooms');
        Route::get('/inventories', [ReportController::class, 'generateInventoriesReport'])->name('inventories');
        Route::get('/admins', [ReportController::class, 'generateAdminsReport'])->name('admins');
        Route::get('/card-payments', [ReportController::class, 'generateCardPaymentsReport'])->name('cardPayments');
        Route::get('/inventory-assignments', [ReportController::class, 'generateInventoryAssignmentsReport'])->name('inventoryAssignments');
        Route::get('/users', [ReportController::class, 'generateUsersReport'])->name('users');
    });
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterUserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterUserController::class, 'register']);
Route::get('/api/room-details/{room}', [PaymentController::class, 'getRoomDetails']);
Route::get('/payments/card', [PaymentController::class, 'cardPaymentForm'])->name('payments.cardPaymentForm');
Route::post('/payments/card/process', [PaymentController::class, 'processCardPayment'])->name('payments.processCardPayment');
Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');

Route::get('reservations/assign/{customer_id}', [ReservationController::class, 'assignRoom'])->name('reservations.assignRoom');
Route::post('reservations/assign', [ReservationController::class, 'storeAssignment'])->name('reservations.storeAssignment');
Route::get('inventory-assignments/create', [InventoryAssignmentController::class, 'create'])->name('inventory_assignments.create')->middleware('auth');
Route::post('inventory-assignments', [InventoryAssignmentController::class, 'store'])->name('inventory_assignments.store')->middleware('auth');

require __DIR__.'/auth.php';
