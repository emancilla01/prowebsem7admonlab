<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspacioTrabajo extends Model
{
    use HasFactory;

    protected $table = 'espacios_trabajo';

    // primary key is id_espacio
    protected $primaryKey = 'id_espacio';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre_espacio',
        'tipo_espacio',
        'ubicacion',
        'capacidad',
        'responsable',
    ];

    public static function rules(?int $id = null): array
    {
        return [
            'nombre_espacio' => ['required', 'string', 'max:255'],
            'tipo_espacio' => ['required', 'string', 'max:255'],
            'ubicacion' => ['nullable', 'string', 'max:255'],
            'capacidad' => ['nullable', 'integer', 'min:0'],
            'responsable' => ['nullable', 'string', 'max:255'],
        ];
    }
}
