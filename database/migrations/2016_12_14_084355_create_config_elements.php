<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigElements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('config_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });
        $config_elements = DB::table('config_elements');
        $config_elements->insert(['name'=>'Project Management']);
        $config_elements->insert(['name'=>'Engineering']);
        $config_elements->insert(['name'=>'Commissioning']);
        $config_elements->insert(['name'=>'HSE']);
        $config_elements->insert(['name'=>'Process']);
        $config_elements->insert(['name'=>'Mechanical Static']);
        $config_elements->insert(['name'=>'Civil Structure']);
        $config_elements->insert(['name'=>'Construction']);
        $config_elements->insert(['name'=>'QA/QC']);
        $config_elements->insert(['name'=>'Contract & Procurement']);
        $config_elements->insert(['name'=>'Project Control']);
        $config_elements->insert(['name'=>'Financial']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('config_elements');
    }
}
