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
        Schema::create('nas', function (Blueprint $table) {
            $table->id();
            $table->string('nasname', 128);
            $table->string('shortname', 32);
            $table->string('type', 30);
            $table->integer('ports');
            $table->string('secret', 60);
            $table->string('server', 64);
            $table->string('community', 50);
            $table->string('description', 200);
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
        Schema::dropIfExists('nas');
    }
};
