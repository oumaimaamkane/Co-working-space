<?php


use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\EquipementController;
use App\Http\Controllers\Api\Admin\EspaceController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\User\ReservationController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Equipement;
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
Route::post('login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});


Route::apiResource('equipements', EquipementController::class);
Route::apiResource('services', ServiceController::class);

Route::apiResource('categories', CategoryController::class);
Route::apiResource('espaces', EspaceController::class);

Route::middleware(['auth:api'])->group(function () {

    Route::apiResource('/user/reservations', ReservationController::class)->names([
        'index' => 'user.reservations.index',
        'create' => 'user.reservations.create',
        'store' => 'user.reservations.store',
        'show' => 'user.reservations.show',
        'edit' => 'user.reservations.edit',
        'update' => 'user.reservations.update',
        'destroy' => 'user.reservations.destroy'
    ]);
});
