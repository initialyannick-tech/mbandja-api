<?php

namespace Modules\Academique\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'libelle'     => 'required|string|max:255',
            'classe_id'   => 'required|exists:classes,id',
            'semestre_id' => 'required|exists:semestres,id',
            'session_id'  => 'required|exists:sessions,id',
            'credit'      => 'nullable|numeric|min:0',
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
            'code.required'        => 'Le code de l\'unité d\'enseignement est obligatoire.',
            'libelle.required'     => 'Le libellé de l\'unité d\'enseignement est obligatoire.',
            'classe_id.required'   => 'La classe est obligatoire.',
            'classe_id.exists'     => 'La classe sélectionnée est invalide.',
            'semestre_id.required' => 'Le semestre est obligatoire.',
            'session_id.required'  => 'La session est obligatoire.',
            'credit.numeric'       => 'Le crédit doit être une valeur numérique.',
            'credit.min'           => 'Le crédit ne peut pas être négatif.',
        ];
    }
}
