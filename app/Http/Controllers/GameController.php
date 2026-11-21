<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Game;
use App\Http\Resources\GameResource;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Использование ресурса GameResource
    public function index()
    {
        $games = Game::all();
        return GameResource::collection($games); // Laravel сам обернет коллекцию внутрь data
    }

    /*
    // Получение всех игр
    public function index()
    {
        $games = Game::all();
        return response()->json([
            'status' => 'success',
            'data' => $games
        ], 200);
    }
    */
    // Использование ресурса GameResource
    public function show($id)
    {
        $game = Game::find($id);

        // использование общего класса ApiException ля обработки ошибки
        if (!$game) {
            throw new ApiException(404);
        }
        /*
        if (!$game) {
            return response()->json([
                'status' => 'Ошибка',
                'message' => 'Игра не найдена'
            ], 404);
        }
        */
        return new GameResource($game); // Одиночный ресурс
    }
    /*
    // Получение одной игры по ID
    // Добавляем передаваемое значение ID
    public function show($id)
    {
        // Ищем игру по её идентификатору
        $game = Game::find($id);

        // Если игра не найдена - ответ в формате JSON - игра не найдена
        if (!$game) {
            return response()->json([
                'status' => 'Not found',
                'message' => 'Game not found'
            ], 404);
        }
        // Если найдена - выводим игру, с дополнительным сообщением status - success
        return response()->json([
            'status' => 'success',
            'data' => $game
        ], 200);
    }
    */
    // Использование ресурса GameResource
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'gamepad' => 'boolean',
        ]);
        $game = Game::create($validated);
        return (new GameResource($game))->response()->setStatusCode(201);
    }
    /*
    // Создание новой игры
    public function store(Request $request)
    {
        // Валидация входящих данных
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'gamepad' => 'boolean',
        ]);
        // Создаем игру и валидируем ее
        $game = Game::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Game created successfully',
            'data' => $game
        ], 201); // 201 - Created
    }
    */
    // Использование ресурса GameResource
    public function update(Request $request, $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json([
                'status' => 'Ошибка',
                'message' => 'Игра не найдена'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'genre' => 'sometimes|required|string|max:255',
            'gamepad' => 'boolean',
        ]);
        $game->update($validated);
        return new GameResource($game);
    }
    /*
    public function update(Request $request, $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json([
                'status' => 'Not found',
                'message' => 'Game not found'
            ], 404);
        }

        // Валидация (правило 'sometimes' означает, что поле не обязательно, но если оно пришло, то его необходимо проверить)
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'genre' => 'sometimes|required|string|max:255',
            'gamepad' => 'boolean',
        ]);

        $game->update($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Game updated successfully',
            'data' => $game
        ], 200);
    }
    */

    // Удаление игры
    public function destroy($id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json([
                'status' => 'Not found',
                'message' => 'Game not found'
            ], 404);
        }
        $game->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Game deleted successfully'
        ], 200);
    }
}
