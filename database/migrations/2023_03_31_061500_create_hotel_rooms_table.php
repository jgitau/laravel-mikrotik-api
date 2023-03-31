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
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->id();
            $table->uuid('hotel_room_uid')->unique();
            $table->string('room_number', 50);
            $table->string('name', 100);
            $table->string('folio_number', 100);
            $table->integer('service_id');
            $table->string('default_cron_type', 100);
            $table->enum('status', ['active', 'deactive']);
            $table->tinyInteger('edit');
            $table->dateTime('change_service_end_time');
            $table->dateTime('arrival');
            $table->dateTime('departure');
            $table->string('no_posting', 50);
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
        Schema::dropIfExists('hotel_rooms');
    }
};
