<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Adjust authorization logic if you have permissions
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $categoria = $this->route('categoria');
        $ignoreId = null;
        if ($categoria && is_object($categoria)) {
            $ignoreId = $categoria->id;
        }

        $unique = 'unique:categorias,nombre';
        if ($ignoreId) $unique .= ',' . $ignoreId;

        return [
            'nombre' => ['required', 'string', 'max:255', $unique],
            'descripcion' => ['nullable', 'string'],
        ];
    }
}
