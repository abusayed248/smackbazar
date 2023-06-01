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
        Schema::create('fruitcastes', function (Blueprint $table) {
            $table->id();
            $table->string('caste_name_en')->nullable();
            $table->string('caste_name_bn')->nullable();
            $table->string('caste_slug_en')->nullable();
            $table->string('caste_slug_bn')->nullable();
            $table->string('caste_image')->nullable();
            $table->boolean('status')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruitcastes');
    }
};
