<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcmDetequcom extends Model
{
    use HasFactory;

    protected $table = 'ecm_detequcom';

    protected $fillable = [
        'id_ecm',
        'id_espacio',
        'serial',
        'modelo',
        'marca',
        'descripcion',
        'estado',
        'fecha_adquisicion',
        'ubicacion',
    ];

    protected $casts = [
        'fecha_adquisicion' => 'date',
    ];

    public function ecm()
    {
        return $this->belongsTo(EcmEqucommob::class, 'id_ecm');
    }

    public function espacio()
    {
        return $this->belongsTo(EspacioTrabajo::class, 'id_espacio');
    }
}
