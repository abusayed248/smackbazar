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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id')->index()->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcat_id')->index()->constrained('subcats')->onDelete('cascade');
            $table->integer('garden_id');
            $table->integer('caste_id');
            $table->integer('admin_id');
            $table->string('p_name_en');
            $table->string('p_slug_en')->nullable();
            $table->string('p_name_bn');
            $table->string('p_slug_bn')->nullable();
            $table->string('p_code');
            $table->longText('p_description_en')->nullable();
            $table->longText('p_description_bn')->nullable();
            $table->string('regular_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('unit')->nullable();
            $table->integer('stock_qty')->nullable();
            $table->string('yt_video_code')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->string('p_views')->nullable();
            $table->boolean('status')->nullable()->default(0);
            $table->boolean('slider')->nullable()->default(0);
            $table->boolean('hot_deal')->nullable()->default(0);
            $table->boolean('today_deal')->nullable()->default(0);
            $table->boolean('featured')->nullable()->default(0);
            $table->boolean('trendy')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
