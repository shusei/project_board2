<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    use HasFactory;

    // 資料表白名單，在此名單上可做變更
    protected $fillable = [
        'user_id',
        'title',
        'mood_id',
        'content',
        'create_at',
        'update_at',
    ];

    public static function getNormalizationDatabase($id = null)
    {
        if (!$id) {
            $results = DB::table('messages AS m')
                ->join('users', 'users.id', '=', 'm.user_id')
                ->join('moods', 'moods.id', '=', 'm.mood_id')
                ->select('m.*', 'users.username', 'moods.mood')
                ->orderByDesc('m.updated_at')
                ->get();

            return $results;
        } else {
            $result = DB::table('messages AS m')
                ->join('users', 'users.id', '=', 'm.user_id')
                ->join('moods', 'moods.id', '=', 'm.mood_id')
                ->select('m.*', 'users.username', 'moods.mood')
                ->where('m.id', '=', $id)
                ->orderByDesc('m.updated_at')
                ->first();

            return $result;
        }
    }
}
