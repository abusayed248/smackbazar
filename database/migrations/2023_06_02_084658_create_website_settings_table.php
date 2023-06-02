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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('address_en')->nullable();
            $table->string('address_bn')->nullable();
            $table->string('phone_en')->nullable();
            $table->string('phone_bn')->nullable();
            $table->string('email')->nullable();
            $table->string('suport_email')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
