<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login() {
        $view = 'user.login';
        // $model =

        return view($view);
    }

    public function logout() {

        Auth::logout();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        $msg = '登出成功';
        return redirect('/')->with('msg', $msg);

    }

    public function loginProcess(Request $request) {

        // $rules = [
        //     'email' => 'required|email|max:64',
        //     'password' => 'required|confirmed|max:128',
        // ];

        $messages = [
            'email.required' => 'Email不可空白',
            'email.email' => 'Email必須是有效的Email地址',
            'password.required' => '密碼不可空白',
        ];

        // $validator = Validator::make($request->all(), $rules, $messages);

        // dd($validator);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //             ->withErrors($validator)
        //             ->withInput();
        // }

        //
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], $messages);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $msg = '登入成功';
            return redirect('/')->with('msg', $msg);
        }

        return back()->withErrors([
            'email' => '使用者登入失敗',
        ]);
    }
}
