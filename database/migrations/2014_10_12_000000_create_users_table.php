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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('company_name')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('gst')->nullable();
            $table->string('registered_office')->nullable();
            $table->string('license_cost')->nullable();
            $table->string('company_id')->nullable();
            $table->string('add_by')->nullable();
            $table->longText('work_area')->nullable();
            $table->string('can_create_mr')->default(0);
            $table->string('can_create_books')->default(0);
            $table->string('flag')->default(0)->comment('Here 0 is inactive and 1 is active');
           $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
