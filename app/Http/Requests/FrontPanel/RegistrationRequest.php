<?php

namespace App\Http\Requests\FrontPanel;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
        $rules['name'] = [
            'required',
            'string',
            'max:255'
        ];
        $rules['email'] = [
            'required',
            'email',
            'max:255',
            'unique:users,email'
        ];
        $rules['password'] = [
            'required',
            'string',
            'max:255',
            'same:password_confirmation'
        ];
        $rules['password_confirmation'] = [
            'required',
            'string',
            'max:255',
            'same:password'
        ];
        $rules['school_attended'] = [
            'required',
            'string',
            'max:255'
        ];
        $rules['about_us'] = [
            'required',
            'string',
            'max:255'
        ];
        $rules['terms_of_service'] = [
            'accepted',
        ];
        $rules['privacy_policy'] = [
            'accepted',
        ];
        return $rules;
    }
}
