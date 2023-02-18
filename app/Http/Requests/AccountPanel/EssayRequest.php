<?php

namespace App\Http\Requests\AccountPanel;

use Illuminate\Foundation\Http\FormRequest;

class EssayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [];
        $rules['topic'] = [
            'required',
            'string',
            'max:10000',
        ];
        $rules['length'] = [
            'required',
            'numeric',
            'max:500'
        ];
        return $rules;
    }
}
