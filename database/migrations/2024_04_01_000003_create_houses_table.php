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
        Schema::create('houses', function (Blueprint $col) {
            $col->id();
            $col->string('title');
            $col->string('location');
            $col->string('price');
            $col->string('status'); // Dijual, Disewa
            $col->integer('beds');
            $col->integer('baths');
            $col->integer('area');
            $col->boolean('is_new')->default(false);
            $col->string('image')->nullable();
            $col->text('description')->nullable();
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
