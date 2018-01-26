<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditTrail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('audit_trail', function (Blueprint $table) {
            $table->increments('id');
            $table->date('created');
            $table->string('properties');
            $table->string('actions');
            $table->string('from');
            $table->string('to');
            $table->string('title');

            /*
             * relationships
             */
            $table->integer('user_id');
            $table->integer('module_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('audit_trail');
    }
}
