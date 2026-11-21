<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiException extends Exception
{
    // Кастомное исключение для стандартизацииответов API
    // позволяет нам выбрасывать ошибки из любого места приложения (контроллеры, сервисы)
    // и позволяет автоматически преобразовать из в единый JSON-формат с нужным HTTP-статусом

    // (200, 201, 300, 401, 404, 500, etc..)
    protected int $statusCode;
    // Внутренний строковый код ошибки для фронтенда
    protected string $errorCode;

    // Конструктор исключения
    public function __construct(string $message, int $statusCode = 400, string $errorCode = 'API_ERROR')
    {
        parent::__construct($message); // Текст сообщения, понятное для человека
        $this->statusCode = $statusCode; // HTTP - статус ответа
        $this->errorCode = $errorCode; // Машинный код ошибки для фронтеда
    }
    // Получение HTTP-статуса ответа
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    // Получение машинного кода ошибки
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    // Метод render - автоматически вызывает при обработке исключения
    // Он перехватывает выброс данного исключения и превращает его в JSON-ответ,
    // избавляя контроллеры от необходимости писать try-catch и response()->json([])
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $this->getMessage(),
            'code' => $this->getErrorCode(),
        ], $this->getStatusCode());
    }
}
