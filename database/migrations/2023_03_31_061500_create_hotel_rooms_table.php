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
            $table->string('name', 100)->default("Guest");
            $table->string('folio_number', 100);
            $table->integer('service_id')->default(0);
            $table->string('default_cron_type', 100);
            $table->enum('status', ['active', 'deactive'])->default("deactive");
            $table->tinyInteger('edit')->default(0);
            $table->dateTime('change_service_end_time')->default("0000-00-00 00:00:00");
            $table->dateTime('arrival')->default("0000-00-00 00:00:00");
            $table->dateTime('departure')->default("0000-00-00 00:00:00");
            $table->string('no_posting', 50)->default("N");
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
