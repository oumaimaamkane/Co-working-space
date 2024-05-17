<?php

<<<<<<< HEAD
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\EquipementController;
use App\Http\Controllers\Api\Admin\EspaceController;
use App\Http\Controllers\Api\Admin\ServiceController;
=======
use App\Http\Controllers\Api\EquipementController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\User\ReservationController;
use App\Http\Controllers\Api\Auth\AuthController;
>>>>>>> a2b84b3872fc1e777bb5b358bad0fc57bd88aab5
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });


    Route::apiResource('equipements', EquipementController::class);
    Route::apiResource('services', ServiceController::class);
<<<<<<< HEAD
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('services', EspaceController::class);
=======
    Route::apiResource('reservations', ReservationController::class);
>>>>>>> a2b84b3872fc1e777bb5b358bad0fc57bd88aab5
