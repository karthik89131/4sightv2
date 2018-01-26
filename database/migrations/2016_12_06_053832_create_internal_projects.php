<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_projects', function (Blueprint $table) {
            $table->increments('id');
			$table->dateTime('created_date');
			$table->dateTime('modified_date');
			$table->string('name', 255);
			$table->dateTime('start_date');
			$table->dateTime('end_date');
			$table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_projects');
    }
}
