<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->string('discord_id')->unique();
            $table->string('avatar');
            $table->string('discord_token');
            $table->string('discord_refresh_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password');
            $table->dropColumn('discord_id');
            $table->dropColumn('avatar');
            $table->dropColumn('discord_token');
            $table->dropColumn('discord_refresh_token');
        });
    }
};
