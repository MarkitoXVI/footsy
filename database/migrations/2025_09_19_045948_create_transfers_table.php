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

    $table->integer('element_out'); // player ID leaving
    $table->integer('element_in');   // player ID joining

    $table->integer('selling_price');
    $table->integer('buying_price');

    $table->integer('gameweek')->nullable();

    $table->timestamps();
        });
    }
}