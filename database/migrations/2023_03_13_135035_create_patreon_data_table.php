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
        Schema::create('patreon_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text('badge')->nullable();
            $table->string('badge_color')->nullable();
            $table->text('badge_title')->nullable();
            $table->integer('pledge_tier')->default(0);
            $table->bigInteger('perks_expire_at')->default(-1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patreon_data');
    }
};
