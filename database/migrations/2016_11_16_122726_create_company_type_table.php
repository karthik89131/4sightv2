<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('config_company_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');


        });
        DB::table('config_company_type')->insert(
            array(
                'id'=>1,
                'name'=>'Client',
            )
        );
        DB::table('config_company_type')->insert(
            array(
                'id'=>2,
                'name'=>'Vendor',
            )
        );
        DB::table('config_company_type')->insert(
            array(
                'id'=>3,
                'name'=>'Supplier',
            )
        );
        DB::table('config_company_type')->insert(
            array(
                'id'=>4,
                'name'=>'Manufacturer',
            )
        );

        DB::table('config_company_type')->insert(
            array(
                'id'=>5,
                'name'=>'Fabricator',
            )
        );
        DB::table('config_company_type')->insert(
            array(
                'id'=>6,
                'name'=>'Engineering',
            )
        );
        DB::table('config_company_type')->insert(
            array(
                'id'=>7,
                'name'=>'Distributor',
            )
        );
        DB::table('config_company_type')->insert(
            array(
                'id'=>8,
                'name'=>'Construction',
            )
        );
        DB::table('config_company_type')->insert(
            array(
                'id'=>9,
                'name'=>'Installer',
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
        Schema::dropIfExists('config_company_type');
    }
}
