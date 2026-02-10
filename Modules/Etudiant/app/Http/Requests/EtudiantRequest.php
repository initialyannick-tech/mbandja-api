<?php

namespace Modules\Etudiant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EtudiantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string',
            'telephone' => 'required|string',
            'email' => [
                'nullable',
                'email',
                Rule::unique('etudiants')->ignore($this->etudiant)
            ],
            'adresse' => 'required|string',
            'sexe' => 'required|string|in:Homme,Femme',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'prenom.required' => 'Le prénom est obligatoire',
            'nom.required' => 'Le nom est obligatoire',
            'date_naissance.required' => 'La date de naissance est obligatoire',
            'lieu_naissance.required' => 'Le lieu de naissance est obligatoire',
            'telephone.required' => 'Le numéro de téléphone est obligatoire',
            'email.email' => 'L\'email doit être une adresse email valide',
            'email.unique' => 'L\'email est déjà utilisé',
            'adresse.required' => 'L\'adresse est obligatoire',
            'sexe.required' => 'Le sexe est obligatoire',
            'sexe.in' => 'Le sexe doit être Homme ou Femme',
           ];
    }

}
