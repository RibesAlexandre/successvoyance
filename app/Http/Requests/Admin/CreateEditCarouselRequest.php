<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateEditCarouselRequest
 * @author Alexandre Ribes
 * @package App\Http\Requests\Admin
 */
class CreateEditCarouselRequest extends FormRequest
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
            'title'     =>  'required|min:3|max:255',
            'begin_at'  =>  'before:ending_at',
            'ending_at' =>  'after:begin_at',
        ];
    }
}
