<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 64)->unique();
            $table->text('value');
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        // 初期データの挿入
        DB::table('settings')->insert([
            [
                'key' => 'MASTER_URL',
                'value' => 'https://localhost/s/',
                'comment' => 'マスターサーバーのURL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'PAGE_MAX',
                'value' => '50',
                'comment' => '1ページあたりの最大表示件数',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'PAGER_LIST',
                'value' => '[10,20,50,100]',
                'comment' => 'ページャーの選択肢',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
