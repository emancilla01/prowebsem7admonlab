<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareMateria extends Model
{
    use HasFactory;

    protected $table = 'software_materias';

    protected $fillable = [
        'id_software',
        'id_materia',
        'observaciones',
    ];

    public function software()
    {
        return $this->belongsTo(Software::class, 'id_software', 'id_software');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia', 'id');
    }
}
