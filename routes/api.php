<?php

use App\Http\Controllers\Api\CekDbController;
use App\Http\Controllers\Api\LoadTesting;
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

Route::get('/cek-db', [CekDbController::class, 'cekDb']);
Route::post('/set-nomkot', [CekDbController::class, 'setNewNomkot']);
Route::get('/data/{count}', [LoadTesting::class, 'loadTesting']);
