<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAttributesList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attributes_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->integer('should_show');
        });
        DB::table('user_attributes_type')->insert(
            array(
                'id'=>1,
                'name'=>'Primary Phone',
                'type'=>'string',
                'should_show'=>1
            )
        );
        DB::table('user_attributes_type')->insert(
            array(
                'id'=>2,
                'name'=>'Secondary Phone',
                'type'=>'string',
                'should_show'=>1
            )
        );
        DB::table('user_attributes_type')->insert(
            array(
                'id'=>3,
                'name'=>'Mailing Address',
                'type'=>'string',
                'should_show'=>1
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
        Schema::dropIfExists('user_attributes_type');
    }
}
