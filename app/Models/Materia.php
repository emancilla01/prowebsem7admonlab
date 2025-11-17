<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'clave',
        'id_carrera',
        'requiere_lab',
        'tipo_uso',
        'estatus',
    ];

    protected $casts = [
        'requiere_lab' => 'boolean',
    ];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'id_carrera', 'id_carrera');
    }

    // Prepared relationships (not fully implemented yet)
    // public function grupos()
    // {
    //     return $this->hasMany(Grupo::class);
    // }

    // public function softwares()
    // {
    //     return $this->belongsToMany(Software::class, 'software_materia', 'materia_id', 'software_id');
    // }

    public static function rules(?int $id = null): array
    {
        $unique = 'unique:materias,clave';
        if ($id) $unique .= ',' . $id;

        return [
            'nombre' => ['required', 'string', 'max:150'],
            'clave' => ['required', 'string', 'max:50', $unique],
            'id_carrera' => ['required', 'exists:carreras,id_carrera'],
            'requiere_lab' => ['boolean'],
            'tipo_uso' => ['nullable', 'string', 'max:50'],
            'estatus' => ['required', 'in:activo,inactivo'],
        ];
    }
}
