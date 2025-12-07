<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaDetalle extends Model
{
    use HasFactory;

    protected $table = 'entradasdetalle';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_entrada',
        'id_ecm_dete',
        'id_ecm_detm',
        'no_serie',
        'id_espaciotrabajo',
    ];

    /**
     * Relations
     */
    public function entrada()
    {
        return $this->belongsTo(Entrada::class, 'id_entrada');
    }

    public function ecmDetequcom()
    {
        return $this->belongsTo(EcmDetequcom::class, 'id_ecm_dete');
    }

    public function ecmDetmob()
    {
        return $this->belongsTo(EcmDetmob::class, 'id_ecm_detm');
    }

    public function espacioTrabajo()
    {
        return $this->belongsTo(EspacioTrabajo::class, 'id_espaciotrabajo', 'id_espacio');
    }
}
