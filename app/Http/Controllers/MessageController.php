<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 列出所有資料
        $results = Message::getNormalizationDatabase();
        $moods = Mood::get();

        return view('index', ['results' => $results], ['moods' => $moods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
        Message::create($request->all());

        return Redirect::back();
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
        $model = [];

        $result = Message::getNormalizationDatabase($id);
        $moods = Mood::get();

        $model['result'] = $result;
        $model['moods'] = $moods;

        // dd($moods);


        return view('edit', $model);
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

        Message::find($id)->update($request->all());

        return Redirect::to('/message');
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

        return Redirect::back();
    }
}
