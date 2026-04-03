<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /* ──────────────────────────────────────────
     | Helpers Estáticos
     ────────────────────────────────────────── */

    /**
     * Retorna o valor de uma configuração.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $value = Cache::rememberForever("setting_{$key}", function () use ($key) {
            return static::where('key', $key)->value('value');
        });

        return $value ?? $default;
    }

    /**
     * Define o valor de uma configuração (cria ou atualiza).
     */
    public static function set(string $key, mixed $value, string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        Cache::forget("setting_{$key}");
    }

    /**
     * Retorna todas as configurações de um grupo como array key=>value.
     */
    public static function group(string $group): array
    {
        return static::where('group', $group)
            ->pluck('value', 'key')
            ->toArray();
    }

    /**
     * Retorna todas as configurações como array key=>value.
     */
    public static function allKeyed(): array
    {
        return static::all()->pluck('value', 'key')->toArray();
    }
}

