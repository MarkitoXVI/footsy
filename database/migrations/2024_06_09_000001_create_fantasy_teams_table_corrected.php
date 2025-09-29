<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop the existing table if it exists
        Schema::dropIfExists('fantasy_teams');
        
        // Create the corrected table
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

    public function down()
    {
        Schema::dropIfExists('fantasy_teams');
    }
};