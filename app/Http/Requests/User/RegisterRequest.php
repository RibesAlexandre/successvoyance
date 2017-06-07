<?php

namespace App\Http\Requests\User;

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
            'name_register'          =>  'required|max:80',
            'firstname_register'     =>  'required|max:80',
            'nickname_register'      =>  'required|max:80|unique:users,nickname',
            'email_register'         =>  'required|email|max:255|unique:users,email',
            'password_register'      =>  'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name_register.required'            =>  'Le champ nom est requis',
            'firstname_register.required'       =>  'Le champ prénom est requis',
            'nickname_register.required'        =>  'Le champ pseudo est requis',
            'nickname_register.unique'          =>  'Ce pseudonyme est déjà utilisé par un autre utilisateur',
            'email_register.required'           =>  'Le champ email est requis',
            'email_register.email'              =>  'Le champ email doit être une adresse email valide',
            'password_register.required'        =>  'Le champ mot de passe est requis',
            'password_register.confirmed'       =>  'Le champ mot de passe doit être confirmé',
            'password_register.min'             =>  'Le champ mot de passe doit faire minimum 6 caractères',
        ];
    }
}
