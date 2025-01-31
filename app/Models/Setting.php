<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'comment'];

    public const KEYS = [
        'MASTER_URL' => 'マスターサーバーのURL',
        'PAGE_MAX' => '1ページあたりの最大表示件数',
        'PAGER_LIST' => 'ページャーの選択肢',
    ];
}
