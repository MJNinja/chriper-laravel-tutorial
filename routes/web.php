<?php

use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ChirpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
	Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.create');
	Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'])->name('chirps.edit');
	Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');
	Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy'])->name('chirps.delete');
});

// Register routes
Route::view('/register', 'auth.register')->middleware('guest')->name('register');
Route::post('/register', Register::class)->middleware('guest');

// Logout
Route::post('/logout', Logout::class)->middleware('auth')->name('logout');
