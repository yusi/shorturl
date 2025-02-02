<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => 'ハヤカワ企画',
            'created_at' => '2025-02-03 01:30:50',
            'updated_at' => '2025-02-03 01:30:50'
        ]);
    }
}