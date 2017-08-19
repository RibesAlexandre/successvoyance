<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'design_name'       =>  'required',
            'design_file'       =>  'required|mimes:jpg,jpeg,png|max:400000'
        ];
    }

    public function messages() {
        return [
            'design_name.required'      =>  'Le nom du média est recquis',
            'design_file.required'      =>  'Le champ image est recquis',
        ];
    }
}
