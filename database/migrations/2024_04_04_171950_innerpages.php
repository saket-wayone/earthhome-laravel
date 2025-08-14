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
        Schema::create('innerpages', function (Blueprint $table) {
            $table->id();
            $table->string('add_by')->nullable();
            $table->string('book_id')->nullable();
            $table->string('title')->nullable();
            $table->string('inner_image')->nullable();
            $table->string('audio_file')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('sequence')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('innerpages');

    }
};
