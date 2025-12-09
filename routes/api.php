<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendasController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    
    Route::get('/users', [AuthController::class, 'usuarios']);
    Route::put('/update/{id}', [AuthController::class, 'update']);
    Route::delete('/delete/{id}', [AuthController::class, 'delete']);

});


Route::post('/fila/entrar', [VendasController::class, 'entrarFila']);
Route::post('/fila/comprar', [VendasController::class, 'FazerCompra']);
Route::get('/fila', [VendasController::class, 'listarFila']);


Route::get('/dashboard', [DashboardController::class, 'index']);