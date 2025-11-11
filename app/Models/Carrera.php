<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    // Use id_carrera as primary key to match provided schema
    protected $primaryKey = 'id_carrera';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre_carrera',
        'clave_carrera',
        'coordinador',
    ];

    public static function rules(?int $id = null): array
    {
        $unique = 'unique:carreras,clave_carrera';
        if ($id) $unique .= ',' . $id . ',id_carrera';

        return [
            'nombre_carrera' => ['required', 'string', 'max:255'],
            'clave_carrera' => ['required', 'string', 'max:100', $unique],
            'coordinador' => ['nullable', 'string', 'max:255'],
        ];
    }
}
