<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaDetalle extends Model
{
    use HasFactory;

    protected $table = 'salidasdetalle';

    protected $fillable = [
        'id_salida',
        'id_entradadetalle',
        'motivo_de_salida',
    ];

    public function salida()
    {
        return $this->belongsTo(Salida::class, 'id_salida');
    }

    public function entradaDetalle()
    {
        return $this->belongsTo(EntradaDetalle::class, 'id_entradadetalle');
    }
}
