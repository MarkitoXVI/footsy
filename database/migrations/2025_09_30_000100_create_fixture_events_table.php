<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fixture_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixture_id')->constrained('fixtures')->onDelete('cascade');
            $table->foreignId('team_id')->nullable()->constrained('teams')->nullOnDelete();
            $table->foreignId('player_id')->nullable()->constrained('players')->nullOnDelete();
            $table->string('player_name')->nullable(); // fallback if player_id is null
            $table->string('type')->default('goal'); // goal, own_goal, pen_goal, pen_miss, card, etc.
            $table->integer('minute')->nullable();
            $table->integer('extra_minute')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->index(['fixture_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fixture_events');
    }
};
