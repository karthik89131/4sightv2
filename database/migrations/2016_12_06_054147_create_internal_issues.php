<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalIssues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_issues', function (Blueprint $table) {
            $table->increments('id');
			$table->dateTime('created_date');
			$table->dateTime('modified_date');
			$table->unsignedInteger('projectid');
			$table->unsignedInteger('taskid');
			$table->string('name', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_issues');
    }
}
