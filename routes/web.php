<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ===== RUTAS DE LOGIN =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== RUTA PRINCIPAL =====
Route::get('/', function () {
    return redirect()->route('productos.index');
})->middleware('auth');

/* Controlador de Productos */
Route::resource('productos', ProductoController::class)->middleware('auth');

/* Controlador de Ventas */
Route::resource('ventas', VentaController::class)->middleware('auth');

/* Controlador de Reportes */
Route::get('/reportes', [ReporteController::class, 'index'])
    ->name('reportes.index')->middleware('auth');
Route::get('/reportes/datos', [ReporteController::class, 'obtenerDatos'])
    ->name('reportes.datos')->middleware('auth');
