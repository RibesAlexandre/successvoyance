<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditPasswordRequest
 * @author Alexandre Ribes
 * @package App\Http\Requests\User
 */
class EditPasswordRequest extends FormRequest
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
            'old_password'  =>  'required',
            'password'      =>  'required|min:6|confirmed',
        ];
    }
}
