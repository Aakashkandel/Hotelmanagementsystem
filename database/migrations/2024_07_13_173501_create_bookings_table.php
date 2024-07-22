<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('room_id');
            $table->string('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('checkin');
            $table->date('checkout');
            $table->integer('guests');
            $table->string('room_type');
            $table->text('message')->nullable();
            $table->string('payment_method');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
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
};
