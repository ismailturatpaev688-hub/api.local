<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // Ресурсы - мощный инструмент для трансформации данных перед отправкой в API.
    // Проблемы которую решают Resources - это избыточность данных, безопасность, форматирование и группировка
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'genre' => $this->genre,
            'gamepad' => (bool) $this->gamepad, // Пребразуем 1/0 в true/false
        ];
    }
}
