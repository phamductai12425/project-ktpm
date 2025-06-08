<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('bio')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
// Đổi tên file migration tạo bảng artists thành ngày trước file tạo bảng songs
// Đổi tên file 2025_06_06_022156_create_artists_table.php thành 2025_06_01_151608_create_artists_table.php hoặc sớm hơn 2025_06_01_151609_create_songs_table.php
