<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profile_picture');
            $table->string('full_name');
            $table->string('email');

            /*
             * relationships
             */
            $table->integer('resource_type_id');
            $table->integer('user_status_id');
            $table->integer('company_id');
            $table->integer('title_id');
            $table->integer('license_id');

            /*
             * hidden/sensitive
             */
            $table->string('password_hash');
            $table->string('forgot_password_token');
            $table->timestamps();
        });
        DB::table('user')->insert(
            array(
                'id'=>1,
                'email'=>'admin@cjpengineering.com',
                'full_name'=>'Admin',
                'password_hash'=>'123123123',
                'company_id'=>1,
                'title_id'=>1,
                'resource_type_id'=>99
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
        Schema::dropIfExists('user');
    }
}
