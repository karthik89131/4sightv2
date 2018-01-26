<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('config_company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('website');
            $table->integer('authority');

            /*
             * relationships
             */
            $table->integer('company_type_id');
            $table->integer('owner_user_id');

        });
        $config_company = DB::table('config_company');
        $config_company->insert(['name'=>'Chemicals Unit']);
        $config_company->insert(['name'=>'Development Unit']);
        $config_company->insert(['name'=>'Engineering Unit']);
        $config_company->insert(['name'=>'Gas Unit']);
        $config_company->insert(['name'=>'Lubricants Unit']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('config_company');
    }
}
