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
        Schema::create('ad', function (Blueprint $table) {
            $table->id();
            $table->string('file_name', 100);
            $table->string('thumb_file_name', 100);
            $table->string('title', 200);
            $table->text('short_description');
            $table->date('promo_date');
            $table->string('url_for_image', 200);
            $table->string('url_for_read_more', 200);
            $table->integer('time_to_show');
            $table->integer('time_to_hide');
            $table->string('device_type', 50);
            $table->string('type', 50);
            $table->string('position', 50);
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
        Schema::dropIfExists('ad');
    }
};
