<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckUserEditFormRequest extends FormRequest
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
            'password' => 'required|confirmed|max:128',
        ];
    }

    public function messages()
    {
        return [
            //
            'password.required' => '密碼不可空白',
            'password.confirmed' => '密碼確認不匹配',
            'password.max' => '密碼不可超個128個字元',
        ];
    }

    // override getValidatorInstance，將 protected 改為 public
    public function getValidatorInstance()
    {
        return parent::getValidatorInstance();
    }
}
