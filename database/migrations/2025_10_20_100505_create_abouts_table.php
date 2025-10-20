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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('درباره ما');
            $table->text('description');
            $table->string('image')->nullable(); // تصویر اصلی (مثل man.png)
            $table->string('background_shape')->nullable(); // shape5.png
            $table->integer('val1')->default(0)->nullable();
            $table->string('val1_label')->default('محصول')->nullable();
            $table->integer('val2')->default(0)->nullable();
            $table->string('val2_label')->default('تعداد مشتریان')->nullable();
            $table->integer('val3')->default(0)->nullable();
            $table->string('val3_label')->default('مدرس')->nullable();
            $table->integer('val4')->default(0)->nullable();
            $table->string('val4_label')->default('نظر شرکت کننده')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
