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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('page', 100);
            $table->string('title', 100);
            $table->string('url', 100);
            $table->unsignedBigInteger('module_id');
            $table->text('allowed_groups');
            $table->tinyInteger('show_menu')->default(0);
            $table->integer('show_to')->nullable();
            $table->timestamps();
            $table->foreign('module_id')
                ->references('module_id')
                ->on('modules')
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
        Schema::dropIfExists('pages');
    }
};
