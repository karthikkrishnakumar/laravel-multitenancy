<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
;
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
//
});

Route::post('login', [AuthController::class, 'login']);

// in a routes file

Route::middleware('tenant')->group(function () {
    Route::post('save_user', [AuthController::class, 'saveUser']);
    Route::post('my_profile', [AuthController::class, 'myProfile']);
});
