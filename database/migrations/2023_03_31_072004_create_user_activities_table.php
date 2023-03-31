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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->string('username', 200);
            $table->string('module', 200);
            $table->string('page', 200);
            $table->string('timestamp', 200);
            $table->string('browser_name', 100);
            $table->integer('browser_version');
            $table->string('os_name',100);
            $table->string('os_version',100);
            $table->string('device_type',100);
            $table->text('params');
            $table->string('ip',50);
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
        Schema::dropIfExists('user_activities');
    }
};
