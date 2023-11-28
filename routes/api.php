<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/listar-producto', [ProductoController::class, 'consulta']);
Route::post('/guardar-producto', [ProductoController::class, 'guardar']);
Route::put('/actualizar-producto/{id}', [ProductoController::class, 'actualizar']);
Route::delete('/eliminar-producto/{id}', [ProductoController::class, 'eliminar']);


Route::get('/listar-proveedor', [ProveedorController::class, 'consulta']);
Route::post('/guardar-proveedor', [ProveedorController::class, 'guardar']);
Route::put('/actualizar-proveedor/{id}', [ProveedorController::class, 'actualizar']);
Route::delete('/eliminar-proveedor/{id}', [ProveedorController::class, 'eliminar']);