<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateEditLinkRequest
 * @author Alexandre Ribes
 * @package App\Http\Requests\Admin
 */
class CreateEditLinkRequest extends FormRequest
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
            'link'          =>  'required',
            'container'     =>  'required',
            'page'          =>  'nullable',
            'parent_id'     =>  'nullable',
        ];

        if( $this->method() == 'POST' ) {
            $rules = array_add($rules, 'name', 'required|min:3|max:30|unique:links');
        } else {
            $rules = array_merge($rules, [
                'name'	=>	'required|max:30|min:3|unique:links,name,' . $this->route()->parameter('id')
            ]);
        }

        return $rules;
    }
}
