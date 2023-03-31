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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->uuid('client_uid')->unique();
            $table->unsignedBigInteger('service_id');
            $table->string('customer_id',50);
            $table->string('username', 50);
            $table->string('password', 100);
            $table->tinyInteger('enable_user');
            $table->smallInteger('simultaneous_use');
            $table->string('static_ip_address', 100);
            $table->string('identification', 100);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('fullname', 100);
            $table->string('birth_place', 100);
            $table->date('birth_date');
            $table->string('phone', 50);
            $table->string('mobile', 50);
            $table->string('email')->unique();
            $table->string('company', 100);
            $table->string('address', 200);
            $table->string('city', 100);
            $table->string('zip', 20);
            $table->tinyInteger('tax');
            $table->date('activation');
            $table->integer('valid_until');
            $table->integer('first_use');
            $table->text('note');
            $table->string('status',100);
            $table->integer('validfrom');
            $table->timestamps();

            $table->foreign('service_id')
              ->references('service_id')
              ->on('services')
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
        Schema::dropIfExists('clients');
    }
};
