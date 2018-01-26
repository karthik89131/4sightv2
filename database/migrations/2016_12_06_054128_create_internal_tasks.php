<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_tasks', function (Blueprint $table) {
            $table->increments('id');
			$table->dateTime('created_date');
			$table->dateTime('modified_date');
			$table->unsignedInteger('projectid');
			$table->string('name', 255);
			$table->dateTime('start_date');
			$table->dateTime('end_date');
			$table->text('description');
			$table->string('progress', 255);
			$table->unsignedInteger('duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_tasks');
    }
}
