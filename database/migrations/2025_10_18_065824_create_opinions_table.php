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
        Schema::create('opinions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // نام شرکت کننده
            $table->string('role')->nullable(); // مثلا "شرکت‌کننده"
            $table->text('comment'); // متن نظر
            $table->string('avatar')->nullable(); // مسیر تصویر
            $table->date('date')->nullable(); // تاریخ نظر
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opinions');
    }
};
