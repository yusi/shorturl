<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    public function redirect($key, Request $request)
    {
        // イベントを取得
        $event = Event::where('key', $key)->first();

        if (!$event) {
            //abort(404);
            //return response()->json(['error' => 'Event not found'], 404); // イベントが見つからない場合
        }

        // ext_user_idを取得
        $ext_user_id = $request->query('id') ?? null;

        // event_usersテーブルに登録
        $eventUser = EventUser::create([
            'event_id' => $event->id,
            'ext_user_id' => $ext_user_id,
            'count' => 1, // 初回アクセス時は1
        ]);

        // countをインクリメント
        $eventUser->increment('count');

        // URLにリダイレクト
        return response()->json(['url' => $event->url], 200);
    }
}