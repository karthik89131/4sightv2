<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');

            /*
             * relationships
             */
            $table->integer('user_id');
            $table->integer('user_attributes_type_id');
        });
        DB::table('user_attributes')->insert(
            array(
                'id'=>1,
                'user_id'=>1,
                'user_attributes_type_id'=>1,
                'value'=>'0123456789'
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
        Schema::dropIfExists('user_attributes');
    }
}
