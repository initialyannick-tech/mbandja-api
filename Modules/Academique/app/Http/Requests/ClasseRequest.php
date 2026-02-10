<?php

namespace Modules\Academique\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
             'libelle'     =>'required|string|max:255',
             'capacite'    =>'nullable|integer|min:1',
             'session_id'  =>'required|exists:sessions,id',
             'cycle_id'    =>'required|exists:cycles,id',
             'semestres.*' =>'exists:semestres,id',
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
            'code.required'     => 'Le code de la classe est obligatoire.',
            'code.unique'       => 'Ce code de classe existe déjà.',
            'libelle.required'  => 'Le libellé de la classe est obligatoire.',
            'capacite.integer'  => 'La capacité doit être un nombre entier.',
            'session_id.exists' => 'La session sélectionnée est invalide.',
            'cycle_id.exists'   => 'Le cycle sélectionné est invalide.',
            'semestres.min'     => 'Une classe doit être associée à au moins deux semestres.'
        ];
    }
}
