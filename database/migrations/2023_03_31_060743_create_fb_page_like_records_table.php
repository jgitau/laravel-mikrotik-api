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
        Schema::create('fb_page_like_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('action_time');
            $table->string('email', 200);
            $table->timestamps();

            $table->foreign('page_id')
              ->references('page_id')
              ->on('pages')
              ->onDelete('cascade')
              ->onUpdate('cascade');

            $table->foreign('user_id')
              ->references('user_id')
              ->on('users_data')
              ->onDelete('cascade')
              ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fb_page_like_records');
    }
};
