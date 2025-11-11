<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
    ];

    /**
     * Validation rules helper similar to other models in this project.
     */
    public static function rules(?int $id = null): array
    {
        $unique = 'unique:periodos,nombre';
        if ($id) $unique .= ',' . $id;

        return [
            'nombre' => ['required', 'string', 'max:255', $unique],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
        ];
    }
}
