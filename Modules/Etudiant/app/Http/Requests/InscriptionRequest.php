<?php

namespace Modules\Etudiant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscriptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'classe_id' => 'required|exists:classes,id',
            'etudiant_id' => 'required|exists:etudiants,id',
            'session_id' => 'required|exists:sessions,id',
            'date_inscription' => 'required|date',
            'statut_paiement' => 'nullable|in:impaye,partiel,solde',
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
            'classe_id.exists' => 'La classe sélectionnée est invalide.',
            'etudiant_id.required' => 'L\'étudiant est obligatoire.',
            'etudiant_id.exists' => 'L\'étudiant sélectionné est invalide.',
            'session_id.required' => 'La session est obligatoire.',
            'session_id.exists' => 'La session sélectionnée est invalide.',
            'date_inscription.required' => 'La date d\'inscription est obligatoire.',
            'date_inscription.date' => 'La date d\'inscription doit être une date valide.',
            'statut_paiement.in' => 'Le statut de paiement doit être : impaye, partiel ou solde.',
        ];
    }
}
