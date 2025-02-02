<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountToEventUsersTable extends Migration
{
    public function up()
    {
        Schema::table('event_users', function (Blueprint $table) {
            $table->integer('count')->after('ext_user_id');
        });
    }

    public function down()
    {
        Schema::table('event_users', function (Blueprint $table) {
            $table->dropColumn('count');
        });
    }
}