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
        Schema::create('macs', function (Blueprint $table) {
            $table->id();
            $table->string('mac_address', 100);
            $table->string('password', 100);
            $table->string('mikrotik_group', 100);
            $table->string('validfrom', 100);
            $table->string('validto', 100);
            $table->enum('status', ['bypassed', 'blocked']);
            $table->text('description');
            $table->string('server', 100);
            $table->string('mikrotik_id', 50);
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
        Schema::dropIfExists('macs');
    }
};
