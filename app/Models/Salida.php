<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $table = 'salidas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'fecha',
        'hora',
        'quien_autorizo',
        'quien_registro',
    ];

    /**
     * Attribute casts
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'date',
    ];
}
