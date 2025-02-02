<?php

namespace Database\Seeders;

use App\Models\EventUser;
use Illuminate\Database\Seeder;

class EventUserSeeder extends Seeder
{
    public function run()
    {
        EventUser::create([
            'event_id' => 1,
            'user' => '111',
            'count' => 1,
            'created_at' => '2025-02-03 01:35:55',
            'updated_at' => '2025-02-03 01:35:55'
        ]);
    }
}