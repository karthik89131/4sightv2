<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('resource_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('needs_license');

        });
        DB::table('resource_type')->insert(
            array(
                'id'=>1,
                'name'=>'User',
                'description'=>'Regular User that needs license',
                'needs_license'=>1
            )
        );
        DB::table('resource_type')->insert(
            array(
                'id'=>2,
                'name'=>'Resource',
                'description'=>'Reference user that is not part of system',
                'needs_license'=>0
            )
        );
        DB::table('resource_type')->insert(
            array(
                'id'=>99,
                'name'=>'Admin',
                'description'=>'A seed user to initialize the system',
                'needs_license'=>0
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
        Schema::dropIfExists('resource_type');
    }
}
