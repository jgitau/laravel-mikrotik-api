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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->uuid('voucher_uid')->unique();
            $table->unsignedBigInteger('voucher_batch_id');
            $table->string('username', 100);
            $table->string('password', 100);
            $table->integer('valid_until');
            $table->integer('first_use');
            $table->string('status', 50);
            $table->tinyInteger('clean_up');
            $table->timestamps();
            $table->foreign('voucher_batch_id')
              ->references('voucher_batch_id')
              ->on('voucher_batches')
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
        Schema::dropIfExists('vouchers');
    }
};
