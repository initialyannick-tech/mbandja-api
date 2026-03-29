<?php

namespace Modules\Note\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'inscription_id' => 'required|exists:inscriptions,id',
            'matiere_id'     => 'required|exists:matieres,id',
            'type' => 'required|in:controle,examen,devoir',
            'libelle' => 'nullable|string|max:255',
            'valeur' => 'required|numeric|min:0|max:20',
            'appreciation' => 'nullable|string',
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
            'inscription_id.required' => 'L\'inscription est obligatoire',
            'inscription_id.exists'   => 'Inscription invalide',
            'matiere_id.required' => 'La matière est obligatoire',
            'matiere_id.exists'   => 'Matière invalide',
            'type.in' => 'Type invalide (controle, examen, devoir)',
            'valeur.required' => 'La note est obligatoire',
            'valeur.numeric'  => 'La note doit être un nombre',
            'valeur.max'      => 'La note ne peut pas dépasser 20',
        ];
    }
}
