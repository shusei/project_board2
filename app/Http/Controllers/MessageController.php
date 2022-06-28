<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // 列出所有資料
        $view = 'index';    // index.blade.php
        $model = array();

        $results = Message::getWithUsersAndMoods();
        $moods = Mood::get();

        $model['results'] = $results;
        $model['moods'] = $moods;

        return view($view, $model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        //
        $view = 'create';   //create.blade.php
        $model = array();

        $moods = Mood::get();

        $model['moods'] = $moods;

        return view($view, $model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Message::create($request->all());
        // dd($this->validated($request) === true);
        $validated = $this->validated($request);
        if ($validated === true) {
            $message = new Message;

            $message->user_id = $request->user_id;
            $message->title = $request->title;
            $message->content = $request->content;
            $message->mood_id = $request->mood_id;

            $message->save();

            $msg = '發表留言成功';
            return redirect('/message')->with('msg', $msg);
        } else {
            return $validated;
        }
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
        dd(Message::getWithUsersAndMoods($id));
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
        $view = 'edit';
        $model = array();

        $result = Message::getWithUsersAndMoods($id);
        $moods = Mood::get();

        $model['result'] = $result;
        $model['moods'] = $moods;

        // dd($moods);


        return view($view, $model);
        // return view('edit', ['result' => $result], ['moods' => $moods]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $message = Message::find($id);

        $validated = $this->validated($request);
        if ($validated === true) {
            $message->title = $request->title;
            $message->content = $request->content;
            $message->mood_id = $request->mood_id;

            $message->save();

            $msg = '修改成功';
            return redirect('/message')->with('msg', $msg);
        } else {
            return $validated;
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
        Message::find($id)->delete();

        return redirect()->back();
    }

    /**
     * 檢查輸入格式
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean | \Illuminate\Routing\Redirector
     */
    public function validated(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|max:10',
                'title' => 'required|max:10',
                'content' => 'required',
            ],
            [
                'user_id.required' => 'User ID 不可空白',
                'user_id.max' => 'User ID 不可超個十個字元',
                'title.required' => '標題不可空白',
                'title.max' => '標題不可超個十個字元',
                'content.required' => '內容不可空白',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        return true;
    }
}
