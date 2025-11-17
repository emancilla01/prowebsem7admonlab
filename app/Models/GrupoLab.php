<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoLab extends Model
{
    use HasFactory;

    protected $table = 'grupos_labs';

    protected $fillable = [
        'id_grupo',
        'id_espacio',
        'horario',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function espacio()
    {
        return $this->belongsTo(EspacioTrabajo::class, 'id_espacio', 'id_espacio');
    }
}
