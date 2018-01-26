<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiskActivity extends Migration
{
    /*
     * proper reconstruction risk register
     */
    private function setupRiskRegister()
    {
        Schema::create('risk_register', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('risk_event');
            $table->longText('direct_impact');
            $table->longText('rationale');

            $table->enum('risk_category', ['organizational', 'stakeholder', 'definition', 'technical']);
            $table->enum('status', ['open', 'close']);

            $table->dateTime('action_due');

            /*
             * relationships
             */
            $table->integer('project_id');

            $table->timestamps();
        });

        /*
         * links risk line items to instance of activity
         */
        Schema::create('risk_register_project_phase_activity', function (Blueprint $table) {
            $table->increments('id');
            /*
             * relationships
             */
            $table->integer('risk_register_id');
            $table->integer('project_phase_activity_id');
            $table->integer('assigned_by_id'); //links to user who added this

            $table->timestamps();
        });

        Schema::create('risk_mitigation', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('mitigation_action');
            $table->longText('mitigation_outcome');
            $table->longText('mitigation_trigger_point');

            $table->enum('mitigation_action_status', ['pending', 'verified', 'closed']);
            $table->enum('mitigation_response_strategy', ['avoid', 'accept', 'transfer', 'share', 'mitigate']);

            $table->dateTime('action_due');

            /*
             * relationships
             */
            $table->integer('mitigation_owner_id');
            $table->integer('risk_register_id');

            $table->timestamps();
        });

        Schema::create('risk_assessment', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('existing_control');

            $table->integer('assessment_cost');
            $table->integer('assessment_schedule');
            $table->integer('assessment_hse');
            $table->integer('assessment_others');
            $table->integer('assessment_likelihood');
            $table->integer('assessment_impact_rating');
            $table->integer('assessment_risk_rating');

            /*
             * relationships
             */

            $table->timestamps();
        });
    }

    private function setupGenericActivities(){

        /*
         * an instance of an activity (Generic, PLL, PIR, PRA or any other)
         */
        Schema::create('project_phase_activity', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name'); //overrides standards name
            $table->longText('venue');
            $table->longText('introduction');
            $table->longText('project_background');
            $table->longText('objective');
            $table->longText('methodology');
            $table->longText('schedule');
            $table->longText('other_pmt');
            $table->longText('other');


            $table->enum('status', ['not_planned', 'pending',
                'completed', 'endorsed', 'late', 'cancelled']);
            $table->dateTime('planned_date_date');
            /*
             * relationships
             */
            $table->integer('config_project_type_id');
            $table->integer('project_phase_id');
            $table->integer('project_id');
            $table->integer('activity_standards_id');
            $table->integer('responsible_person_id');


            $table->timestamps();
        });



        /*
         * user association module
         */
        Schema::create('activity_resources', function (Blueprint $table) {
            $table->increments('id');

            /*
             * relationships
             */
            $table->integer('user_id');
            $table->integer('project_phase_activity_id');
            $table->enum('role', ['scribe', 'creator']); //TODO: clarify purpose of each role

            $table->timestamps();
        });

        /*
         * user association module
         */
        Schema::create('activity_documentation', function (Blueprint $table) {
            $table->increments('id');

            /*
             * relationships
             */
            $table->integer('documentation_id');
            $table->integer('project_phase_activity_id');

            $table->timestamps();
        });

        /*
         * extends project_phase_activity for PRA type
         */
        Schema::create('project_phase_activity_pra', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('pra_objective');
            $table->longText('pra_target');
            $table->longText('pra_very_low');
            $table->longText('pra_low');
            $table->longText('pra_moderate');
            $table->longText('pra_high');
            $table->longText('pra_very_high');

            /*
             * relationships
             */
            $table->integer('project_phase_activity_id');

            $table->timestamps();
        });

        /*
         * extends project_phase_activity for PRA type
         */
        Schema::create('project_phase_activity_pir', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('pir_subject_issues');
            $table->longText('pir_findings');
            $table->longText('pir_supporting_facts');
            $table->longText('pir_recommendations');

            $table->enum('pir_ratings', ['A', 'B', 'C']);
            $table->enum('pir_status', ['open', 'close']);

            $table->longText('pir_pmt_response');
            $table->longText('pir_pmt_outcome');
            $table->longText('pir_pmt_action_by_id'); //user id
            $table->dateTime('pir_pmt_due_date');

            $table->longText('pir_pmd_comment_status');
            $table->longText('pir_pmd_follow_up_id'); //user id
            $table->dateTime('pir_pmd_comment');

            /*
             * relationships
             */
            $table->integer('project_phase_activity_id');
            //$table->integer('potential_issue'); //use risk_register_project_phase_activity


            $table->timestamps();
        });

        /*
         * extends project_phase_activity for PLL type
         */
        Schema::create('project_phase_activity_pll', function (Blueprint $table) {
            $table->increments('id');

            $table->longText('pll_expected');
            $table->longText('pll_occurred');
            $table->longText('pll_went_well');
            $table->longText('pll_went_wrong');
            $table->longText('pll_actions_taken');
            $table->longText('pll_be_improved');
            $table->longText('pll_to_document');

            $table->enum('pll_impact_levels', ['1',
                '2', '3', 'G']);

            /*
             * relationships
             */
            $table->integer('config_elements_id');
            $table->integer('project_phase_activity_id');
            //$table->integer('potential_issue'); //use risk_register_project_phase_activity


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
        $this->setupGenericActivities();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('risk_register');
        Schema::dropIfExists('risk_register_activity');
        Schema::dropIfExists('risk_mitigation');
        Schema::dropIfExists('risk_assessment');
        Schema::dropIfExists('project_generic_activity');
    }
}
