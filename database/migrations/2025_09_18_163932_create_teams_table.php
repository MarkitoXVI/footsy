<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name');
            $table->string('code')->nullable();
            $table->integer('strength')->default(0);
            $table->integer('strength_overall_home')->default(0);
            $table->integer('strength_overall_away')->default(0);
            $table->integer('strength_attack_home')->default(0);
            $table->integer('strength_attack_away')->default(0);
            $table->integer('strength_defense_home')->default(0);
            $table->integer('strength_defense_away')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
};