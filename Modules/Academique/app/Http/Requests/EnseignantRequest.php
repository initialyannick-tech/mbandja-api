<?php

namespace Modules\Academique\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnseignantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email'=> [
                'required',
                'email',
                Rule::unique('enseignants')->ignore($this->enseignant)
            ],
            'telephone' => 'nullable|string|max:20',
            'specialite' => 'nullable|string|max:150',
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
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.email' => 'Email invalide.',
            'email.unique' => 'Cet email est déjà utilisé.',
        ];
    }
}
