<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Message extends Model
{
    use HasFactory;

    // 資料表白名單，在此名單上可做變更
    protected $fillable = [
        'user_id',
        'title',
        'mood_id',
        'content',
    ];

    public static function findWithUsersAndMoods($id = null, $q = null, $itemsPerPage = 15)
    {
        $results = DB::table('messages AS m')
            ->join('users AS u', 'u.id', '=', 'm.user_id')
            ->LeftJoin('moods AS ms', 'ms.id', '=', 'm.mood_id')
            ->select('m.*', 'u.username', 'ms.mood')
            ->orderByDesc('m.updated_at');

        if(isset($id) && is_null($q)) {
            $results = $results->where('m.id', '=', $id);
        }

        if(isset($q)) {
            $results = $results->where('u.username', 'LIKE', '%'.$q.'%')
                                ->orWhere('m.title', 'LIKE', '%'.$q.'%')
                                ->orWhere('m.content', 'LIKE', '%'.$q.'%');
        }

        return $results->paginate($itemsPerPage)->withQueryString();


        // $messages = DB::table('messages AS m')
        //                 ->join('users AS u', 'u.id', '=', 'm.user_id')
        //                 ->LeftJoin('moods AS ms', 'ms.id', '=', 'm.mood_id')
        //                 ->select('m.*', 'u.username', 'ms.mood')
        //                 ->orderByDesc('m.updated_at')
        //                 ->where('u.username', 'LIKE', '%'.$request->search.'%')
        //                 ->orWhere('m.title', 'LIKE', '%'.$request->search.'%')
        //                 ->orWhere('m.content', 'LIKE', '%'.$request->search.'%')
        //                 ->get();


        // // LeftJoin 左邊的資料表全部加入搜尋，即使右邊的資料表有缺也沒事
        // $results = DB::table('messages AS m')
        //     ->join('users AS u', 'u.id', '=', 'm.user_id')
        //     ->LeftJoin('moods AS ms', 'ms.id', '=', 'm.mood_id')
        //     ->select('m.*', 'u.username', 'ms.mood')
        //     // when的用法，第一個參數為true，執行第一個涵式，false則執行第二個涵式
        //     ->when($id, function($query, $id){
        //         return $query->where('m.id', '=', $id);
        //     })
        //     ->orderByDesc('m.updated_at') //
        //     ->when($id, function($query){
        //         return $query->first();
        //     }, function($query){
        //         return $query->get();
        //     });

        //     return $results;
    }
}
