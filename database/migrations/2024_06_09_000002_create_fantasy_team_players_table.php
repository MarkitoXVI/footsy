<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fantasy_team_players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fantasy_team_id')->constrained()->onDelete('cascade');
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->boolean('is_substitute')->default(false);
            $table->integer('position_order')->nullable();
            $table->boolean('is_captain')->default(false);
            $table->timestamps();

            $table->unique(['fantasy_team_id', 'player_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('fantasy_team_players');
    }
};
