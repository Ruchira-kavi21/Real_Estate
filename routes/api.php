<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PropertyController;

Route::post('/login', [AuthController::class, 'login']); // Changed from /api/login to /login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/properties', [PropertyController::class, 'index']);
Route::post('/properties', [PropertyController::class, 'store']);
Route::get('/properties/{id}', [PropertyController::class, 'show']);
Route::put('/properties/{id}', [PropertyController::class, 'update']);
Route::delete('/properties/{id}', [PropertyController::class, 'destroy']);