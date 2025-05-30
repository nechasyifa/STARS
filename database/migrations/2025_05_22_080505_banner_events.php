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
        Schema::create('m_banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_nama')->nullable();
            $table->string('banner_link')->nullable();
            $table->string('banner_gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_banners');
    }
};
