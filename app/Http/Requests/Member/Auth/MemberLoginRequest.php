<?php

namespace App\Http\Requests\Member\Auth;

use Illuminate\Foundation\Http\FormRequest;

class MemberLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required|min:4',
            'remember' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The name field is required',
            'password.required' => 'Password is required',
        ];
    }
}
