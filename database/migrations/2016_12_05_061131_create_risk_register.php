<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiskRegister extends Migration
{
    private function setupRiskRegister(){
        Schema::create('risk', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('risk_event');
            $table->longText('direct_impact');
            $table->longText('rationale');
            $table->longText('existing_control');
            $table->longText('mitigation_action');
            $table->longText('mitigation_outcome');
            $table->longText('mitigation_trigger_point');

            $table->integer('cost');
            $table->string('tag');
            $table->integer('schedule');
            $table->integer('hse');
            $table->integer('others');
            $table->integer('likelihood');
            $table->integer('overall_impact');
            $table->integer('risk_rating');
            $table->integer('residual_likelihood');
            $table->integer('residual_impact');
            $table->integer('residual_rating');

            $table->enum('risk_category', ['organizational', 'stakeholder', 'definition', 'technical']);
            $table->enum('response_strategy', ['avoid', 'accept', 'transfer', 'share', 'mitigate']);
            $table->enum('mitigation_action_status', ['pending','verified','closed']);
            $table->enum('status', ['open','close']);

            $table->dateTime('action_due');

            /*
             * relationships
             */
            $table->integer('project_id');
            $table->integer('action_owner'); //points to a user

            $table->timestamps();
        });

        /*
         * facilitate joins between activity and risk
         */
        Schema::create('risk_activity', function (Blueprint $table) {
            $table->increments('id');

            /*
             * relationships
             */
            $table->integer('risk_id');
            $table->integer('activity_id');

            $table->timestamps();
        });
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $this->setupRiskRegister();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('risk');
        Schema::dropIfExists('risk_activity');
    }
}
