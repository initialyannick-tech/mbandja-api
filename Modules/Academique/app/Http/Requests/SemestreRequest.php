<?php

namespace Modules\Academique\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SemestreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'libelle' => 'required|string|max:255'
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
            'libelle.required' => 'Le libellé du semestre est obligatoire.',
            'ordre.required'   => 'L\'ordre du semestre est obligatoire.',
        ];
    }
}
