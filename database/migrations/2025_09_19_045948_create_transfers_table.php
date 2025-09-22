<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fantasy_team_id')->constrained()->onDelete('cascade');
            $table->foreignId('player_in_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('player_out_id')->constrained('players')->onDelete('cascade');
            $table->integer('gameweek');
            $table->boolean('is_wildcard')->default(false);
            $table->boolean('is_free_hit')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transfers');
    }
};