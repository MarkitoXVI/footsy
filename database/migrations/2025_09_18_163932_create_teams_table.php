<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('teams', function (Blueprint $table) {
        $table->id();
        $table->unsignedInteger('fpl_id')->unique();   // FPL 'teams[].id'
        $table->string('name');
        $table->string('short_name', 10)->nullable();  // 'short_name'
        $table->unsignedInteger('code')->nullable();   // 'code'
        $table->unsignedTinyInteger('strength')->nullable();
        $table->unsignedTinyInteger('strength_overall_home')->nullable();
        $table->unsignedTinyInteger('strength_overall_away')->nullable();
        $table->unsignedTinyInteger('strength_attack_home')->nullable();
        $table->unsignedTinyInteger('strength_attack_away')->nullable();
        $table->unsignedTinyInteger('strength_defence_home')->nullable();
        $table->unsignedTinyInteger('strength_defence_away')->nullable();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('teams');
    }
};