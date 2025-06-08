<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDurationToSongsTable extends Migration
{
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }

    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->integer('duration')->nullable()->after('image_path');
        });
    }
}