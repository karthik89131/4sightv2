<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('config_title', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prefix');
            $table->string('postfix');
            $table->string('name');
        });
        DB::table('config_title')->insert(
            array(
                'id'=>1,
                'prefix'=>'Mr',
                'name'=>'Gentlemen'
            )
        );
        DB::table('config_title')->insert(
            array(
                'id'=>2,
                'prefix'=>'Mrs',
                'name'=>'Lady'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('config_title');
    }
}
