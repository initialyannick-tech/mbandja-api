<?php

namespace Modules\Academique\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseMatiereRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
             'classe_id' => 'required|exists:classes,id',
             'matieres' => 'required|array|min:1',
             'matieres.*' => 'exists:matieres,id',
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
            'classe_id.required' => 'La classe est obligatoire.',
            'classe_id.exists' => 'Classe invalide.',
            'matieres.required' => 'Veuillez sélectionner au moins une matière.',
            'matieres.array' => 'Le format des matières est invalide.',
            'matieres.min' => 'Au moins une matière est requise.',
            'matieres.*.exists' => 'Une des matières sélectionnées est invalide.',
        ];
    }
}
