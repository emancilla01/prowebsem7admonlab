<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    protected $table = 'software';

    // primary key is id_software
    protected $primaryKey = 'id_software';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre_software',
        'version',
        'licencia',
        'proveedor',
        'fecha_instalacion',
        'id_espacio',
    ];

    public static function rules(?int $id = null): array
    {
        return [
            'nombre_software' => ['required', 'string', 'max:255'],
            'version' => ['nullable', 'string', 'max:100'],
            'licencia' => ['nullable', 'string', 'max:255'],
            'proveedor' => ['nullable', 'string', 'max:255'],
            'fecha_instalacion' => ['nullable', 'date'],
            'id_espacio' => ['nullable', 'integer', 'exists:espacios_trabajo,id_espacio'],
        ];
    }
}
