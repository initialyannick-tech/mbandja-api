<?php

namespace Modules\Etudiant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'libelle' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'etudiant_id' => 'required|exists:etudiants,id',

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
            'libelle.required' => 'Le libelle est obligatoire.',
            'file.required' => 'Le fichier est obligatoire.',
            'file.mimes' => 'Le fichier doit être un PDF ou un document Word.',
            'file.max' => 'La taille du fichier ne doit pas dépasser 2 Mo.',
            'etudiant_id.required' => 'L\'étudiant est obligatoire.',
            'etudiant_id.exists' => 'L\'étudiant spécifié n\'existe pas.',
        ];
    }

}
