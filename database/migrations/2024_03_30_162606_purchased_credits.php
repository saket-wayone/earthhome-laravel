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
        Schema::create('purchasedcredits', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->nullable();
            $table->string('plan_id')->nullable();
            $table->string('unique_code')->nullable();
            $table->string('alloted_user_id')->nullable();
            $table->string('alloted_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasedcredits');

    }
};
