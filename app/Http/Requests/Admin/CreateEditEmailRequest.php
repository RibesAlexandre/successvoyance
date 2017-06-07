<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateEditEmailRequest
 * @author Alexandre Ribes
 * @package App\Http\Requests\Admin
 */
class CreateEditEmailRequest extends FormRequest
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
            'amount'    =>  'required|numeric',
            'quantity'  =>  'required|integer',
        ];

        if( $this->method() === 'POST' ) {
            $rules = array_merge($rules, [
                'name'	=>	'required|max:50|min:5|unique:telling_emails,name',
            ]);
        } else {
            $rules = array_merge($rules, [
                'name'	=>	'required|max:50|min:5|unique:telling_emails,name,' . $this->route()->parameter('voyance_email'),
            ]);
        }

        return $rules;
    }
}
