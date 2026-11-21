<?php

use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Короткое написание, создает базовые маршруты, как в примере ниже, только одной строкой
Route::apiResource('games', GameController::class);

// prefix v1 - Предназначен для хранения версий, v2 - будут использоваться новые группы маршрутов,
// которые будут переходить на те же url адреса, только обновленные
Route::prefix('v1')->group(function () {

    // GET - Получить список
    Route::get('/games', [GameController::class, 'index']);

    // POST - Создать новую игру
    Route::post('/games', [GameController::class, 'store']);

    // GET - Получить одну игру, вывести ее
    Route::get('/games/{id}', [GameController::class, 'show']);

    // PUT - Обновить игру
    Route::put('/games/{id}', [GameController::class, 'update']);

    // DELETE - Удалить игру
    Route::delete('/games/{id}', [GameController::class, 'destroy']);

});
