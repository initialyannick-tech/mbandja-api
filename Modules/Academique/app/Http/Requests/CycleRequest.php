<?php

namespace Modules\Academique\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CycleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'libelle'    =>'required|string|max:255',
            'ordre'      =>'required|string|max:50',
            'session_id' =>'required|exists:sessions,id'
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
            'libelle.required'    => 'Le libellé du cycle est obligatoire.',
            'ordre.required'      => 'L\'ordre du cycle est obligatoire.',
            'session_id.required' => 'La session académique est obligatoire.',
            'session_id.exists'   => 'La session académique sélectionnée est invalide.',
        ];
    }
}
