<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('players', function (Blueprint $table) {
        $table->id();
        $table->unsignedInteger('fpl_id')->unique();    // elements[].id
        $table->unsignedInteger('code')->nullable();     // elements[].code
        $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
        $table->unsignedTinyInteger('element_type');     // 1 GKP, 2 DEF, 3 MID, 4 FWD
        $table->string('first_name');
        $table->string('second_name');
        $table->string('web_name')->nullable();
        $table->decimal('price', 5,1)->default(0);       // now_cost / 10
        $table->decimal('form', 4,1)->default(0);
        $table->string('points_per_game')->nullable();   // string in FPL API
        $table->unsignedInteger('total_points')->default(0);
        $table->unsignedInteger('minutes')->default(0);
        $table->unsignedInteger('goals_scored')->default(0);
        $table->unsignedInteger('assists')->default(0);
        $table->unsignedInteger('clean_sheets')->default(0);
        $table->unsignedInteger('yellow_cards')->default(0);
        $table->unsignedInteger('red_cards')->default(0);
        $table->string('status', 10)->nullable();        // 'a' available, 'i' injured...
        $table->string('news')->nullable();
        $table->string('photo')->nullable();             // e.g. "12345.jpg"
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
