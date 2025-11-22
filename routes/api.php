<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::post('/fila/entrar', [VendasController::class, 'entrarFila']);
Route::post('/fila/comprar', [VendasController::class, 'FazerCompra']);
Route::get('/fila', [VendasController::class, 'listarFila']);