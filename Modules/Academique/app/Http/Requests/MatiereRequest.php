<?php

namespace Modules\Academique\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatiereRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'unite_id'    => 'required|exists:unites,id',
            'libelle'     => 'required|string|max:255',
            'coefficient' => 'nullable|numeric|min:0.1',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'unite_id.required' => 'L\'unité d\'enseignement est obligatoire.',
            'unite_id.exists'   => 'L\'unité d\'enseignement sélectionnée est invalide.',
            'code.required'     => 'Le code de la matière est obligatoire.',
            'libelle.required'  => 'Le libellé de la matière est obligatoire.',
            'coefficient.min'   => 'Le coefficient doit être supérieur à zéro.',
        ];
    }
}
