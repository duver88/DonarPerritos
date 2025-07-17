<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloodDonorController;
use App\Http\Controllers\AdminBloodDonorController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rutas públicas - WEB 1: Formulario de registro
Route::prefix('registro-donante')->group(function () {
    Route::get('/', [BloodDonorController::class, 'create'])->name('blood-donors.create');
    Route::post('/', [BloodDonorController::class, 'store'])->name('blood-donors.store');
    Route::get('/exitoso', [BloodDonorController::class, 'success'])->name('blood-donors.success');
});

// Rutas públicas - WEB 2: Donantes disponibles
Route::prefix('donantes-disponibles')->group(function () {
    Route::get('/', [BloodDonorController::class, 'index'])->name('blood-donors.index');
    Route::get('/{donor}', [BloodDonorController::class, 'show'])->name('blood-donors.show');
});

// Rutas de administración - usando middleware directamente
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('donantes')->name('blood-donors.')->group(function () {
        Route::get('/', [AdminBloodDonorController::class, 'index'])->name('index');
        Route::get('/{donor}', [AdminBloodDonorController::class, 'show'])->name('show');
        Route::post('/{donor}/aprobar', [AdminBloodDonorController::class, 'approve'])->name('approve');
        Route::post('/{donor}/rechazar', [AdminBloodDonorController::class, 'reject'])->name('reject');
        Route::post('/accion-masiva', [AdminBloodDonorController::class, 'bulkAction'])->name('bulk-action');
        Route::post('/{donor}/cambiar-estado', [AdminBloodDonorController::class, 'changeStatus'])->name('change-status');

    });
});

// Rutas de perfil (de Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta raíz redirige a donantes disponibles
Route::get('/', function () {
    return redirect()->route('blood-donors.index');
});

// Ruta home que espera Breeze
Route::get('/home', function () {
    return redirect()->route('blood-donors.index');
})->name('home');

// Ruta dashboard que espera Breeze
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    // Si es admin, va al panel de administración
    if (auth()->user()->is_admin ?? false) {
        return redirect()->route('admin.blood-donors.index');
    }
    // Si es usuario normal, va a donantes disponibles
    return redirect()->route('blood-donors.index');
})->name('dashboard');

// Dashboard de administración
Route::middleware(['auth', 'verified', 'admin'])->get('/admin', function () {
    return redirect()->route('admin.blood-donors.index');
})->name('admin.dashboard');

// Incluir las rutas de autenticación de Breeze
require __DIR__.'/auth.php';