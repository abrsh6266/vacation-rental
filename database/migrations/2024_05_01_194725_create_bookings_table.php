<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('check_in');
            $table->string('check_out');
            $table->integer('days');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('user_id');
            $table->string('hotel_name');
            $table->string('room_name');
            $table->string('status')->default('pending');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Add more foreign key constraints as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
