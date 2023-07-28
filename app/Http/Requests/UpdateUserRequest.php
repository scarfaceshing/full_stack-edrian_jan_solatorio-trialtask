<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => ['required', 'min:5', 'max:50', 'regex:/^[a-z0-9]+$/u'],
            'email' => ['required', 'email:rfc,dns'],
            'phone_number' => ['required', 'regex:/^[0-9]+$/u'],
            'password' => ['required', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'min:5', 'max:250', 'confirmed'],
            'password_confirmation' => ['required'],
            'role' => ['required', 'in:ADMIN,USER']
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password should have atleast letter, number and special character',
        ];
    }
}
