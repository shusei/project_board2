<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAndEditFormRequest extends FormRequest
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
            //
            'title' => 'required|max:10',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
            'title.required' => '標題不可空白',
            'title.max' => '標題不可超個十個字元',
            'content.required' => '內容不可空白',
        ];
    }

    // override getValidatorInstance，將 protected 改為 public
    public function getValidatorInstance()
    {
        return parent::getValidatorInstance();
    }
}
