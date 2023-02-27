<?php

namespace App\Http\Requests\FrontPanel;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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

        $rules['email'] = [
            'required',
            'email',
            'max:255',
            function($attribute, $value, $fail) {
                $user = User::where('email', $value)->where('for', 'Account Panel')->first();
                if (empty($user)) {
                    $fail('No account found associated with your provided email address!');
                }
            }
        ];

        return $rules;
    }
}
