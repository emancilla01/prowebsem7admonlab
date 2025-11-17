<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcmDetmob extends Model
{
    use HasFactory;

    protected $table = 'ecm_detmob';

    protected $fillable = [
        'id_ecm',
        'codigo',
        'descripcion',
        'material',
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
}
