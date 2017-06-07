<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email_login'       =>  'required|email',
            'password_login'    =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'email_login.required'      =>  'Le champ email est obligatoire.',
            'email_login.email'         =>  'Le champ email doit être une adresse email valide.',
            'password_login.required'   =>  'Le champ mot de passe est obligatoire.'
        ];
    }
}
