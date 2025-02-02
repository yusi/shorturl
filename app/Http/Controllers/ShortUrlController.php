<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShortUrlController extends Controller
{
    public function redirect($eventKey, Request $request)
    {
        // イベントを取得
        $event = Event::where('key', $eventKey)->first();
        if (!$event) {
            abort(404);
        }

        // ext_user_idを取得
        $user = $request->query('id');

        // イベントユーザーが存在するかどうかをチェックし、存在しない場合は作成
        EventUser::updateOrCreate(
            ['event_id' => $event->id, 'user' => $user],
            ['count' => EventUser::where('event_id', $event->id)->where('user', $user)->exists() ? DB::raw('count + 1') : 1]
        );

        // 指定サイトにリダイレクト
        return redirect()->to($event->url);
    }
}