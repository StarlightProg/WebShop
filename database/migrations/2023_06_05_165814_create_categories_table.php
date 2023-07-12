<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) { 
            $table->id(); 
            $table->string('category_name')->unique(); 
        });

        DB::table('categories')->insert([
            ['category_name' => 'Clothes'],
            ['category_name' => 'Jeans'],
            ['category_name' => 'Bags'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
