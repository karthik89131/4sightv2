<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigDiscipline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('config_discipline', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });
        $config_discipline = DB::table('config_discipline');
        $config_discipline->insert(['name'=>'Electrical']);
        $config_discipline->insert(['name'=>'Mechanical']);
        $config_discipline->insert(['name'=>'Civil']);
        $config_discipline->insert(['name'=>'Safety']);
        $config_discipline->insert(['name'=>'Pipe']);
        $config_discipline->insert(['name'=>'Structural']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('config_discipline');
    }
}
