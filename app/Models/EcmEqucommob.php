<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcmEqucommob extends Model
{
    use HasFactory;

    protected $table = 'ecm_equcommob';

    protected $fillable = [
        'codigo',
        'descripcion',
        'id_categoria',
        'tipo',
        'estado',
        'fecha_alta',
    ];

    /**
     * Cast attributes to appropriate types.
     */
    protected $casts = [
        'fecha_alta' => 'date',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function ecmdetequcom()
    {
        return $this->hasMany(EcmDetequcom::class, 'id_ecm');
    }

    public function ecmdetmob()
    {
        return $this->hasMany(EcmDetmob::class, 'id_ecm');
    }

    // Alias methods with more descriptive names for clarity.
    // Keep the original method names for backward compatibility.
    public function detallesEquipo()
    {
        return $this->hasMany(EcmDetequcom::class, 'id_ecm');
    }

    public function detallesMobiliario()
    {
        return $this->hasMany(EcmDetmob::class, 'id_ecm');
    }
}
