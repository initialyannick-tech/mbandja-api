<?php

namespace Modules\Etudiant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaiementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'inscription_id' =>'required|integer:exists:inscriptions,id',
            'montant' =>'required|numeric:min:0.01',
            'date_paiement' =>'required|date',
            'mode_paiement' =>'nullable|string:max:100',
            'reference' => 'nullable|string:max:1000',
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
            'inscription_id.required' => "L'inscription est obligatoire.",
            'inscription_id.exists' => "L'inscription sélectionnée est invalide.",
            'montant.required' => "Le montant est obligatoire.",
            'montant.numeric' => "Le montant doit être un nombre valide.",
            'montant.min' => "Le montant doit être supérieur à 0.",
            'date_paiement.required' => "La date de paiement est obligatoire.",
            'date_paiement.date' => "La date de paiement est invalide.",
            'mode_paiement.string' => "Le mode de paiement doit être une chaîne de caractères.",
            'mode_paiement.max' => "Le mode de paiement ne doit pas dépasser 100 caractères.",
            'reference.string' => "La référence doit être une chaîne de caractères.",
            'reference.max' => "La référence ne doit pas dépasser 1000 caractères.",
        ];
    }
}
