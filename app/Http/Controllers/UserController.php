<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckNewUserFormRequest;
use App\Http\Requests\CheckUserEditFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $view = 'user.createAndEdit';
        // $model = array();

        return view($view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckNewUserFormRequest $request)
    {

        //
        $msg = '註冊成功，請登入';
        $validator = $request->getValidatorInstance();

        // if (isset($request->email)) {
        //     // 新增一個errors裡面的錯誤訊息給它，語法 use(外部變數)
        //     $validator->after(function ($validator) use ($request) {
        //         if (!is_null(DB::table('users')->where('email', $request->email)->first())) {
        //             $validator->errors()->add(
        //             'emailExist', '此帳號Email已經註冊過，請使用其它Email帳號。'
        //             );
        //         }
        //     });
        // }

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/user/login')->with('msg', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if($id == Auth::id()) {
            $view = 'user.createAndEdit';
            $model = array();
            $user = User::find($id);

            if(is_null($user)) {
                return redirect('/')->with('msg', '使用者不存在');
            }

            $model['user'] = $user;
            return view($view, $model);
        } else {
            $msg = '使用者異常，修改密碼頁面載入失敗';
            return redirect('/')->with('msg', $msg);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckUserEditFormRequest $request, $id)
    {
        //
        // $message = Message::find($id);
        // dd($id);
        if($id == Auth::id()) {
            $msg = '修改密碼成功';
            $validator = $request->getValidatorInstance();

            if ($validator->fails()) {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }

            $user = User::find($id);

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('/')->with('msg', $msg);
        } else {
            $msg = '使用者異常，修改密碼失敗';
            return redirect('/')->with('msg', $msg);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 檢查註冊輸入格式
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function checkNewUserForm(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|max:32',
                'email' => 'required|email|max:64',
                'password' => 'required|confirmed|max:128',
            ],
            [
                'username.required' => '姓名不可空白',
                'username.max' => '姓名不可超個32個字元',
                'email.required' => 'Email不可空白',
                'email.email' => 'Email必須是有效的Email地址',
                'email.max' => 'Email不可超個64個字元',
                'password.required' => '密碼不可空白',
                'password.confirmed' => '密碼確認不匹配',
                'password.max' => '密碼不可超個128個字元',
            ]
        );

        return $validator;
    }

    /**
     * 檢查修改輸入格式
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // public function checkUserEditForm(Request $request)
    // {
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'password' => 'required|confirmed|max:128',
    //         ],
    //         [
    //             'password.required' => '密碼不可空白',
    //             'password.confirmed' => '密碼確認不匹配',
    //             'password.max' => '密碼不可超個128個字元',
    //         ]
    //     );

    //     return $validator;
    // }
}
