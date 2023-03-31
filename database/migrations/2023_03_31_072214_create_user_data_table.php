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
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_data_uid')->unique();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('phone_number', 50);
            $table->string('room_number', 50);
            $table->dateTime('date');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('location', 50);
            $table->string('gender', 50);
            $table->string('birthday', 50);
            $table->string('login_with', 50);
            $table->string('mac', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data');
    }
};
