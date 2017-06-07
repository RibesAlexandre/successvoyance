<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateEditPageRequest
 * @author Alexandre Ribes
 * @package App\Http\Requests\Admin
 */
class CreateEditPageRequest extends FormRequest
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
        $rules = [
            'content'   =>  'required',
        ];

        if( $this->method() === 'POST' ) {
            $rules = array_merge($rules, [
                'name'	=>	'required|max:250|min:5|unique:pages,name',
            ]);
        } else if( $this->method() === 'PATCH' ) {
            $rules = array_merge($rules, [
                'name'	=>	'required|max:250|min:5|unique:pages,name,' . $this->route()->parameter('page'),
            ]);
        }

        return $rules;
    }
}
