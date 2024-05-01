<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->integer('max_persons');
            $table->integer('size');
            $table->integer('num_beds');
            $table->string('price');
            $table->string('view');
            $table->unsignedBigInteger('hotel_id'); // Define as unsignedBigInteger
            $table->foreign('hotel_id')->references('id')->on('hotels'); // Add foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
