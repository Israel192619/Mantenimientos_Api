<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* Route::middleware('auth:sanctum')->group(function () { */
    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('tecnicos', TecnicoController::class);
    Route::post('/tecnicos/{id}', [TecnicoController::class, 'update']);
    Route::apiResource('tareas', TareaController::class);
    Route::post('/tareas/{id}', [TareaController::class, 'update']);
    Route::apiResource('equipos', EquipoController::class);
    Route::post('/equipos/{id}', [EquipoController::class, 'update']);
    Route::apiResource('mantenimientos', MantenimientoController::class);
    Route::post('/mantenimientos/{id}', [MantenimientoController::class, 'update']);
    Route::apiResource('organizations', OrganizationController::class);
/* }); */
