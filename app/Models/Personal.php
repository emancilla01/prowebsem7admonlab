<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rfc',
        'nombre',
        'apellido_pat',
        'apellido_mat',
        'email',
        'sexo',
        'depto',
        'photo',
    ];

    /**
     * Allowed values for the sexo field.
     */
    public const SEXO_VALUES = ['m', 'f', 'other'];

    /**
     * Return validation rules for this model.
     * Helper you can use from controllers or form requests.
     *
     * @param  int|null  $id  Optional id to ignore on unique checks when updating.
     * @return array
     */
    public static function rules(?int $id = null): array
    {
        $uniqueEmail = 'unique:personals,email';
        if ($id) {
            $uniqueEmail .= ',' . $id;
        }

        return [
            'rfc' => ['required', 'string', 'max:255'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido_pat' => ['required', 'string', 'max:255'],
            'apellido_mat' => ['required', 'string', 'max:255'],
            'email' => array_merge(['required', 'email', 'max:255'], [$uniqueEmail]),
            'sexo' => ['required', 'in:' . implode(',', self::SEXO_VALUES)],
            'depto' => ['nullable', 'string', 'max:255'],
        ];
    }
}
