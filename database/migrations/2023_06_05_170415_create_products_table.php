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
            $table->string('cover'); 
            $table->json('images')->nullable(); 
            $table->string('product_name')->unique(); 
            $table->decimal('price', 10, 2); 
            $table->text('description'); 
            $table->string('size'); 
            $table->integer('discount')->nullable();
            $table->foreignId('category_id')->constrained('category'); 
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
