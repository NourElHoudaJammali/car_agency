<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\AdminController;

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

// Public routes
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Authentication routes
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::view('/dashboard', 'dashboard')
        ->middleware('verified')
        ->name('dashboard');
    
    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    // Car Management
    Route::resource('cars', CarController::class);
    
    // Customer Management
    Route::resource('customers', CustomerController::class);
    
    // Rental Management
    Route::resource('rentals', RentalController::class);
    Route::post('rentals/{rental}/return', [RentalController::class, 'return'])
        ->name('rentals.return');
    
    // Admin routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');
    });
});