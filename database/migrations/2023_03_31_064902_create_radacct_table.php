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
        Schema::create('radacct', function (Blueprint $table) {
            $table->id('radacctid');
            $table->string('acctsessionid', 64);
            $table->string('acctuniqueid', 32);
            $table->string('username', 64);
            $table->string('groupname', 64);
            $table->string('realm', 64);
            $table->string('nasipaddress', 15);
            $table->string('nasportid', 15);
            $table->string('nasporttype', 32);
            $table->dateTime('acctstarttime');
            $table->dateTime('acctstoptime');
            $table->string('acctsessiontime', 12);
            $table->string('acctauthentic', 32);
            $table->string('connectinfo_start', 50);
            $table->string('connectinfo_stop', 50);
            $table->integer('acctinputoctets');
            $table->integer('acctoutputoctets');
            $table->string('calledstationid', 50);
            $table->string('callingstationid', 50);
            $table->string('acctterminatecause', 32);
            $table->string('servicetype', 32);
            $table->string('framedprotocol', 32);
            $table->string('framedipaddress', 15);
            $table->string('acctstartdelay', 12);
            $table->string('acctstopdelay', 12);
            $table->string('xascendsessionsvrkey', 10);
            $table->dateTime('acctupdatetime');
            $table->integer('acctinterval');
            $table->string('framedipv6address', 45);
            $table->string('framedipv6prefix', 45);
            $table->string('framedinterfaceid', 44);
            $table->string('delegatedipv6prefix', 45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radacct');
    }
};
