<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('league_user', function (Blueprint $table) {
            if (!Schema::hasColumn('league_user', 'is_admin')) {
                $table->boolean('is_admin')->default(false);
            }

            if (!Schema::hasColumn('league_user', 'rank')) {
                $table->integer('rank')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('league_user', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'rank']);
        });
    }
};