<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEditCommentRequest extends FormRequest
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
            'content'   =>  'required|min:10',
            'stars'     =>  'required_without:parent_id'
        ];
    }

    public function messages()
    {
        return [
            'stars.required_without'    =>  'Vous devez attribuer une note au voyant pour continuer.'
        ];
    }
}
