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
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
        $table->string('name')->nullable();        
        $table->string('logo')->nullable();        
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('mobile')->nullable();
        $table->string('address')->nullable();
        $table->text('about')->nullable();         
        $table->string('map_embed')->nullable();    
        $table->string('copyright')->nullable();   
        $table->timestamps();
    });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_infos');
    }
};
