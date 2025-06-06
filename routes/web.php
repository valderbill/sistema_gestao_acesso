<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/redirect', function () {
    $perfil = Auth::user()->perfil;

    return match ($perfil) {
        'administrador' => redirect()->route('admin.dashboard'),
        'vigilante' => redirect()->route('vigilante.dashboard'),
        'recepcionista' => redirect()->route('recepcionista.dashboard'),
        default => redirect()->route('home'),
    };
})->middleware(['auth'])->name('perfil.redirect');

Route::middleware(['auth'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/vigilante/dashboard', 'vigilante.dashboard')->name('vigilante.dashboard');
    Route::view('/recepcionista/dashboard', 'recepcionista.dashboard')->name('recepcionista.dashboard');
    Route::view('/home', 'home')->name('home');
});
