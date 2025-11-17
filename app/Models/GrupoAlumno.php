<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAlumno extends Model
{
    use HasFactory;

    protected $table = 'grupos_alumnos';

    protected $fillable = [
        'id_grupo',
        'alumno_nombre',
        'alumno_matricula',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }
}
