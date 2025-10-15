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
        Schema::create('hero_banners', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable(); // "کسب و کار آنلاینت رو راه اندازی کن"
            $table->string('title')->nullable(); // "روش های کاربردی کسب درآمد آنلاین"
            $table->text('description')->nullable(); // "ارائه دهنده ابزارهای لازم ..."
            $table->string('highlight_text')->nullable(); // "کمترین زمان و با کمترین هزینه"
            $table->string('primary_button_text')->nullable(); // "شروع کنید"
            $table->string('primary_button_link')->nullable(); // لینک دکمه اول
            $table->string('secondary_button_text')->nullable(); // "مشاوره بگیرید"
            $table->string('secondary_button_link')->nullable(); // لینک دکمه دوم
            $table->string('main_image')->nullable(); // woman1.png
            $table->string('shape_image')->nullable(); // shape5.png
            $table->timestamps();
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_banners');
    }
};
