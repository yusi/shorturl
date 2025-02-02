<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    protected $fillable = [
        'event_id',
        'ext_user_id',
        'count',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
