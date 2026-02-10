<?php

namespace Modules\Etudiant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
          return [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'telephone' => 'required|string',
            'type' => 'required|string|in:père,mère,tuteur,autre',
            'etudiant_id' => 'required|integer|exists:etudiants,id',
        ];

    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

     public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prénom est obligatoire',
            'telephone.required' => 'Le téléphone est obligatoire',
            'type.required' => 'Le type est obligatoire',
            'type.in' => 'Le type doit être père, mère, tuteur ou autre',
            'etudiant_id.required' => 'L\'étudiant est obligatoire',
            'etudiant_id.integer' => 'L\'étudiant doit être un entier',
            'etudiant_id.exists' => 'L\'étudiant n\'existe pas',
        ];
    }

}
