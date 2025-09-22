<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->enum('type', ['public', 'private'])->default('public');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_public')->default(true);
            $table->integer('max_participants')->nullable();
            $table->string('scoring_system')->default('standard');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leagues');
    }
};