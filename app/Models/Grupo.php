<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_grupo',
        'clave_grupo',
        'id_materia',
        'id_periodo',
        'id_personal',
        'id_carrera',
        'turno',
        'estatus',
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia', 'id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo', 'id');
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'id_personal', 'id');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'id_carrera', 'id_carrera');
    }

    public function gruposLabs()
    {
        return $this->hasMany(GrupoLab::class, 'id_grupo');
    }

    public function gruposAlumnos()
    {
        return $this->hasMany(GrupoAlumno::class, 'id_grupo');
    }

    public static function rules(?int $id = null): array
    {
        $unique = 'unique:grupos,clave_grupo';
        if ($id) $unique .= ',' . $id;

        return [
            'nombre_grupo' => ['required', 'string', 'max:100'],
            'clave_grupo' => ['required', 'string', 'max:50', $unique],
            'id_materia' => ['required', 'exists:materias,id'],
            'id_periodo' => ['required', 'exists:periodos,id'],
            'id_personal' => ['required', 'exists:personals,id'],
            'id_carrera' => ['required', 'exists:carreras,id_carrera'],
            'turno' => ['nullable', 'string', 'max:20'],
            'estatus' => ['required', 'string', 'max:20'],
        ];
    }
}
