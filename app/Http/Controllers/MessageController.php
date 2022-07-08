<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAndEditFormRequest;
use App\Models\Message;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        $searchItem = $request->input('q');
        // var_dump($searchItem);
        if($searchItem === null && $searchItem !== "") {
            // dd('index');
            // 列出所有資料
            $view = 'message.index';    // index.blade.php
            $model = array();

            $messages = Message::findWithUsersAndMoods();


            $model['messages'] = $messages;

            return view($view, $model);
        } else {
            // dd('search');

            $view = 'message.index';
            $model = array();

            $messages = Message::findWithUsersAndMoods(null, $searchItem);

            $model['messages'] = $messages;


            return view($view, $model);

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $view = 'message.createAndEdit';   //edit.blade.php
        $model = array();

        $moods = Mood::get();
        $model['moods'] = $moods;

        return view($view, $model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Controllers\MessageController::update
     */
    public function store(CreateAndEditFormRequest $request)
    {
        return $this->update($request);
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
        // dd(Message::getWithUsersAndMoods($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $message = Message::findWithUsersAndMoods($id);
        if($message->isEmpty()) {
            return redirect('/')->with('msg', '編輯目標不存在');
        }

        if($message[0]->user_id == Auth::id()) {

            $view = 'message.createAndEdit';
            $model = array();

            $model['message'] = $message[0];
            $moods = Mood::get();
            $model['moods'] = $moods;

            return view($view, $model);
        } else {
            $msg = '使用者異常，載入編輯頁面失敗';
            return redirect('/')->with('msg', $msg);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreateAndEditFormRequest $request, $id = null)
    {
        $validator = $request->getValidatorInstance();

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        if (isset($id)) {
            $msg = '修改成功';
            $message = Message::find($id);

            if($message->user_id != Auth::id()) {
                $msg = '使用者異常，執行修改失敗';
                return redirect('/')->with('msg', $msg);
            }
        } else {
            $msg = '發表留言成功';
            $message = new Message;
            $message->user_id = Auth::id();
        }

        $message->title = $request->title;
        $message->content = $request->content;
        $message->mood_id = $request->mood_id;
        $message->save();

        return redirect('/')->with('msg', $msg);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $msg = '刪除成功';
        $message = Message::find($id);

        if (isset($message)) {

            if($message->user_id == Auth::id()) {
                $message->delete();
            } else {
                $msg = '使用者異常，刪除失敗';
                return redirect('/')->with('msg', $msg);
            }
        } else {
            $msg = '無此筆資料';
        }

        return redirect()->back()->with('msg', $msg);
    }

    /**
     * 檢查輸入格式
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // public function validated(Request $request)
    // {
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'title' => 'required|max:10',
    //             'content' => 'required',
    //         ],
    //         [
    //             'title.required' => '標題不可空白',
    //             'title.max' => '標題不可超個十個字元',
    //             'content.required' => '內容不可空白',
    //         ]
    //     );

    //     return $validator;
    // }
}
