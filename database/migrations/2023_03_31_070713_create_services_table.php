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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name', 64);
            $table->string('type', 25);
            $table->tinyInteger('burst_mode');
            $table->integer('ul_rate');
            $table->integer('dl_rate');
            $table->integer('ul_br_rate');
            $table->integer('dl_br_rate');
            $table->integer('ul_br_trh');
            $table->integer('dl_br_trh');
            $table->mediumInteger('ul_br_time');
            $table->mediumInteger('dl_br_time');
            $table->smallInteger('priority');
            $table->integer('session_timeout');
            $table->integer('idle_timeout');
            $table->tinyInteger('bandwidth_change');
            $table->string('from',2);
            $table->string('to',2);
            $table->tinyInteger('bc_burst_mode');
            $table->integer('bc_ul_rate');
            $table->integer('bc_dl_rate');
            $table->integer('bc_ul_br_rate');
            $table->integer('bc_dl_br_rate');
            $table->integer('bc_ul_br_trh');
            $table->integer('bc_dl_br_trh');
            $table->integer('bc_ul_br_time');
            $table->integer('bc_dl_br_time');
            $table->smallInteger('bc_priority');
            $table->enum('validity_type',['none','after_created','after_first_login']);
            $table->integer('validity');
            $table->enum('unit_validity',['days', 'weeks', 'months', 'years']);
            $table->integer('time_limit');
            $table->enum('unit_time',['minutes', 'hours', 'days']);
            $table->enum('time_limit_type',[
              'none',
              'one_time_continuous',
              'one_time_gradually',
              'weekly_reset',
              'monthly_reset',
            ]);
            $table->tinyInteger('enable_limit');
            $table->decimal('cost', 10, 2);
            $table->string('currenct', 3);
            $table->tinyInteger('for_purchase');
            $table->integer('purchase_duration');
            $table->enum('unit_time_purchase', ['hours', 'days']);
            $table->string('description', 200);
            $table->integer('volume_limit');
            $table->enum('volume_limit_unit', ['MB', 'GB']);
            $table->bigInteger('volume_limit_bytes');
            $table->integer('validfrom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
