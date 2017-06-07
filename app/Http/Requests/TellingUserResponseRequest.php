<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TellingUserResponseRequest
 * @author Alexandre Ribes
 * @package App\Http\Requests
 */
class TellingUserResponseRequest extends FormRequest
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
            'content'       =>  'required|min:20',
            'topic'         =>  'required|max:250',
            'identifier'    =>  'required'
        ];
    }
}
