<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditPictureRequest
 * @author Alexandre Ribes
 * @package App\Http\Requests\User
 */
class EditPictureRequest extends FormRequest
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
            'picture'   =>  'required|mime:png,jpg,jpeg|max:2500'
        ];
    }
}
