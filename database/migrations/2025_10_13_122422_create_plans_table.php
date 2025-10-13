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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('icon')->nullable(); 
            $table->string('subtitle')->nullable(); 
            $table->string('price')->nullable(); 
            $table->string('period')->nullable(); 
            $table->string('button_text')->nullable(); 
            $table->boolean('is_popular')->default(false); 
            $table->text('features')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
