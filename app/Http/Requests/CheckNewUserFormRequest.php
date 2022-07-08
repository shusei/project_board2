<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class CheckNewUserFormRequest extends FormRequest
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
            'username' => 'required|max:32',
            'email' => 'required|email|max:64|unique:users,email',
            'password' => 'required|confirmed|max:128',
        ];
    }

    public function messages()
    {
        return [
            //
            'username.required' => '姓名不可空白',
            'username.max' => '姓名不可超個32個字元',
            'email.required' => 'Email不可空白',
            'email.email' => 'Email必須是有效的Email地址',
            'email.max' => 'Email不可超個64個字元',
            'email.unique' => '此帳號Email已經註冊過，請使用其它Email帳號。',
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


    // 學會使用 unique:users,email 之後就用不這個method了

    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         if (!is_null(DB::table('users')->where('email', $this->email)->first())) {
    //             $validator->errors()->add(
    //                 'emailExist', '此帳號Email已經註冊過，請使用其它Email帳號。'
    //             );
    //         }
    //     });
    // }
}
