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
        Schema::create('subcats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id')->index()->constrained('categories')->onDelete('cascade');
            $table->string('subcat_name_en');
            $table->string('subcat_name_bn');
            $table->string('subcat_slug_en');
            $table->string('subcat_slug_bn');
            $table->boolean('status')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcats');
    }
};
