<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Return validation rules for this model (optional helper).
     */
    public static function rules(?int $id = null): array
    {
        $unique = 'unique:categorias,nombre';
        if ($id) $unique .= ',' . $id;

        return [
            'nombre' => ['required', 'string', 'max:255', $unique],
            'descripcion' => ['nullable', 'string'],
        ];
    }
}
