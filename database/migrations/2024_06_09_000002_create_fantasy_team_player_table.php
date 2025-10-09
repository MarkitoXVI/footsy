<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fantasy_team_player', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fantasy_team_id')->constrained()->onDelete('cascade');
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->boolean('is_substitute')->default(false);
            $table->string('position_order')->nullable(); // "0,1,2..." for XI, or "sub1,sub2..." for bench
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fantasy_team_player');
    }
};
