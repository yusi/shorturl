<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'service_id' => 1,
            'key' => 'cp',
            'name' => 'イベント1',
            'url' => 'https://google.com',
            'starts_at' => '2025-02-03 01:31:21',
            'expires_at' => '2026-02-03 01:31:24',
            'created_at' => '2025-02-03 01:31:34',
            'updated_at' => '2025-02-03 01:31:34'
        ]);
    }
}