<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['service_id', 'name', 'url'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function eventUsers()
    {
        return $this->hasMany(EventUser::class);
    }
}
