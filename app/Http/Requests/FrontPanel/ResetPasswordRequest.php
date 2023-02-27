<?php

namespace App\Http\Requests\FrontPanel;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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

        $rules['verification_token'] = [
            'required',
            'string',
            'min:40',
            'max:40'
        ];

        $rules['verification_code'] = [
            'required',
            'digits:6',
            function($attribute, $value, $fail) {
                if (empty(User::where('verification_token', $this->verification_token)->where('verification_code', $value)->first())) {
                    $fail('Incorrect Verification Code');
                }
            }
        ];

        $rules['password'] = [
            'required',
            'string',
            'min:6',
            'max:20',
            'same:password_confirmation'
        ];

        $rules['password_confirmation'] = [
            'required',
            'string',
            'min:6',
            'max:20',
            'same:password'
        ];

        return $rules;
    }
}
