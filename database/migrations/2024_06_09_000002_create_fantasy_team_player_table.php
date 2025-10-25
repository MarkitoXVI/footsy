<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('fantasy_team_player', function (Blueprint $table) {
        $table->id();
        $table->foreignId('fantasy_team_id')->constrained()->onDelete('cascade');
        $table->foreignId('player_id')->constrained()->onDelete('cascade');
        $table->boolean('is_starter')->default(true);
        $table->string('position')->nullable();
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('fantasy_team_players');
    }
};
