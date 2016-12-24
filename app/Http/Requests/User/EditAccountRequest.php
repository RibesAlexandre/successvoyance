<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserEditAccountRequest
 * @author Alexandre Ribes
 * @package App\Http\Requests\User
 */
class EditAccountRequest extends FormRequest
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
            'name'          =>  'required|max:255',
            'firstname'     =>  'required|max:255',
            'email'         =>  'required|max:255|email'
        ];
    }
}
