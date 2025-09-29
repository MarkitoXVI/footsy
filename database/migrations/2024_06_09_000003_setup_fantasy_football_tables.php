<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Fantasy Teams Table
        if (!Schema::hasTable('fantasy_teams')) {
            Schema::create('fantasy_teams', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('team_name');
                $table->string('formation')->default('4-4-2');
                $table->decimal('total_budget', 8, 2)->default(100.00);
                $table->decimal('spent_budget', 8, 2)->default(0.00);
                $table->decimal('remaining_budget', 8, 2)->default(100.00);
                $table->integer('total_points')->default(0);
                $table->timestamps();
            });
        }

        // Players Table
        if (!Schema::hasTable('players')) {
            Schema::create('players', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('team');
                $table->string('position');
                $table->decimal('price', 5, 2);
                $table->integer('points')->default(0);
                $table->timestamps();
            });
        }

        // Fantasy Team Players Pivot Table
        if (!Schema::hasTable('fantasy_team_players')) {
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
    }

    public function down()
    {
        Schema::dropIfExists('fantasy_team_players');
        Schema::dropIfExists('fantasy_teams');
        Schema::dropIfExists('players');
    }
};
