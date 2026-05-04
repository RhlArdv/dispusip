<?php

use App\Http\Controllers\ArsipAPIController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the application and will be assigned to the "api"
| middleware group. Make something great!
|
*/

// Public API v1
Route::prefix('v1')->group(function () {
    // Arsip/Dokumen API
    Route::get('dokumen', [ArsipAPIController::class, 'index']);
    Route::get('dokumen/{id}', [ArsipAPIController::class, 'show']);
});
