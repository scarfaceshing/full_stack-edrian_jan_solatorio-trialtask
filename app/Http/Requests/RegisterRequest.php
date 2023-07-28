<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'unique:users', 'max:50', 'min:5', 'regex:/^[a-z0-9]+$/u'],
            'email' => ['required', 'unique:users', 'email:rfc,dns'],
            'phone_number' => ['required', 'regex:/^[0-9]+$/u'],
            'password' => ['required', 'min:6', 'max:250', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'username.regex' => 'Username should have atleast letter, and number',
            'password.regex' => 'Password should have atleast capital letter, number, and special character',
        ];
    }
}
