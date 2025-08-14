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
        Schema::create('feedbacl_models', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->string('name')->nullable();
            $table->string('contact')->nullable();
            $table->string('suject')->nullable();
            $table->longText('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacl_models');
    }
};
