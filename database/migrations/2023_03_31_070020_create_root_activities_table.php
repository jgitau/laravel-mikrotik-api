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
        Schema::create('root_activities', function (Blueprint $table) {
            $table->id();
            $table->string('username', 200);
            $table->string('module', 200);
            $table->string('page', 200);
            $table->string('timestamp', 200);
            $table->string('browser_name', 200);
            $table->integer('browser_version');
            $table->string('os_name', 50);
            $table->string('os_version', 50);
            $table->string('device_type', 50);
            $table->text('params');
            $table->string('ip', 25);
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
        Schema::dropIfExists('root_activities');
    }
};
