<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome'); // Ahora SÍ existe la vista
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard protegido
Route::get('/dashboard', function () {
    $user = auth()->user();
    return "
        <h1>🎉 BIENVENIDO AL DASHBOARD</h1>
        <p><strong>Usuario:</strong> {$user->name}</p>
        <p><strong>Email:</strong> {$user->email}</p>
        <form method='POST' action='/logout'>
            " . csrf_field() . "
            <button type='submit' style='background: #ff2d20; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;'>
                Cerrar Sesión
            </button>
        </form>
    ";
})->middleware('auth')->name('dashboard');