<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    protected $pt1,$pt2,$pt3;

    private function setupProject(){
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag');
            $table->string('name');
            $table->longText('description');
            $table->string('capex_currency');
            $table->decimal('capex_cost', 10, 2);
            $table->string('sanction_currency');
            $table->decimal('sanction_cost', 10, 2);
            $table->enum('status', ['active', 'not-active', 'completed']);

            /*
             * relationships
             */
            $table->integer('config_project_type_id');
            $table->integer('config_project_classification_id');
            $table->integer('config_company_id');
            $table->integer('config_business_id');
            $table->integer('config_contracting_mode_id');
            $table->integer('location_id');
            $table->integer('current_phase_id');

            /*
             * project_sponsor_id, project_director_id and project_manager_id is a user
             */
            $table->integer('project_sponsor_id');
            $table->integer('project_director_id');
            $table->integer('project_manager_id');

            $table->timestamps();
        });
        Schema::create('project_user', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('assigned_date');

            /*
             * relationships
             */
            $table->integer('project_id');
            $table->integer('user_id');
            $table->integer('assigned_by'); //user id

            $table->timestamps();
        });
        Schema::create('project_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('tag');
            $table->dateTime('value');

            /*
             * relationships
             */
            $table->integer('project_id');

            $table->timestamps();
        });
        Schema::create('project_plant_capacity_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag');
            $table->string('unit');
            $table->string('value');

            /*
             * relationships
             */
            $table->integer('project_id');
            $table->integer('config_plant_capacity_id');

            $table->timestamps();
        });
        Schema::create('project_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('value');

            /*
             * relationships
             */
            $table->integer('project_id');

            $table->timestamps();
        });
    }

    private function setupConfig(){
        Schema::create('config_project_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');

            $table->timestamps();
        });

        Schema::create('config_project_classification', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');

            $table->timestamps();
        });

        Schema::create('config_business', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });


        Schema::create('config_project_plant_capacity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });

        Schema::create('config_project_date_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tag');
            $table->boolean('required');
            $table->string('description');
        });

        Schema::create('config_currency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');

            $table->timestamps();
        });

        Schema::create('config_contracting_mode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');

            $table->timestamps();
        });


        $config_project_type = DB::table('config_project_type');
        $this->pt1 = $config_project_type->insertGetId(['name'=>'Brownfield']);
        $this->pt2 = $config_project_type->insertGetId(['name'=>'Greenfield']);
        $this->pt3 = $config_project_type->insertGetId(['name'=>'Hybrid']);

        $config_project_classification = DB::table('config_project_classification');
        $config_project_classification->insert(['name'=>'Oil and Gas']);
        $config_project_classification->insert(['name'=>'Refinery']);
        $config_project_classification->insert(['name'=>'Ethylene and Derivatives']);
        $config_project_classification->insert(['name'=>'Petrochemical and Polymers']);
        $config_project_classification->insert(['name'=>'Chemicals']);
        $config_project_classification->insert(['name'=>'Power Station / Co-generation']);
        $config_project_classification->insert(['name'=>'Ports']);
        $config_project_classification->insert(['name'=>'Steam Cracker Complex']);
        $config_project_classification->insert(['name'=>'UIO And Special Packages']);
        $config_project_classification->insert(['name'=>'Construction Infrastructure']);
        $config_project_classification->insert(['name'=>'Water Treatment Plants']);
        $config_project_classification->insert(['name'=>'Pipelines']);
        $config_project_classification->insert(['name'=>'Aromatics']);

        $config_project_classification = DB::table('config_project_classification');
        $config_project_classification->insert(['name'=>'Upstream']);
        $config_project_classification->insert(['name'=>'Downstream']);

        $config_contracting_mode = DB::table('config_contracting_mode');
        $config_contracting_mode->insert(['name'=>'EPCC']);
        $config_contracting_mode->insert(['name'=>'EPC']);
        $config_contracting_mode->insert(['name'=>'EPCIC']);

        $config_project_plant_capacity = DB::table('config_project_plant_capacity');
        $config_project_plant_capacity->insert(['name'=>'Hrs']);
        $config_project_plant_capacity->insert(['name'=>'Kbd']);
        $config_project_plant_capacity->insert(['name'=>'KM']);
        $config_project_plant_capacity->insert(['name'=>'mins']);
        $config_project_plant_capacity->insert(['name'=>'MW']);

        $config_currency = DB::table('config_currency');
        $config_currency->insert(['name'=>'USD', 'description'=>'United States Dollar']);
        $config_currency->insert(['name'=>'MYR', 'description'=>'Malaysian Ringgit']);
        $config_currency->insert(['name'=>'AUD', 'description'=>'Australian Dollar']);
        $config_currency->insert(['name'=>'SGD', 'description'=>'Singapore Dollar']);

        $config_project_date_type = DB::table('config_project_date_type');
        $config_project_date_type->insert(['name'=>'Project Sanction Date', 'tag'=>'project_sanction_date', 'required'=>true]);
        $config_project_date_type->insert(['name'=>'Mechanical Completion Date', 'tag'=>'machanical_completion_date', 'required'=>true]);
        $config_project_date_type->insert(['name'=>'Start-Up Date', 'tag'=>'start_up_date', 'required'=>true]);
        $config_project_date_type->insert(['name'=>'Initial Acceptance(IA) Date', 'tag'=>'initial_acceptance_date', 'required'=>true]);
        $config_project_date_type->insert(['name'=>'Defect Liability Period Date', 'tag'=>'defect_liability_date', 'required'=>true]);
        $config_project_date_type->insert(['name'=>'Final Acceptance Date', 'tag'=>'final_acceptance_date', 'required'=>true]);
    }

    private function setupTypeAndActivity(){
        /*
         * project type activity is meant to be copied from config_project_type to project_type
         * after project setup,
         * this gives flexibility to change phases(not likely) and activity independently
         */

        Schema::create('config_project_type_phase', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('order');

            //links to project type
            $table->integer('config_project_type_id');

            $table->timestamps();
        });


        Schema::create('project_phase', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->dateTime('planned_start_date');
            $table->dateTime('planned_end_date');
            $table->dateTime('actual_start_date');
            $table->dateTime('actual_end_date');
            $table->integer('order');
            /*
             * relationships
             */
            $table->integer('config_project_type_id');
            $table->integer('project_id');

            $table->timestamps();
        });

        Schema::create('project_phase_gatekeepers', function (Blueprint $table) {
            $table->increments('id');
            /*
             * relationships
             */
            $table->integer('added_by_user');
            $table->integer('target_user');
            $table->integer('project_phase_id');

            $table->timestamps();
        });

        $phases = DB::table('config_project_type_phase');

        $p1 = $phases->insertGetId(['name'=>'Framing', 'description'=>'Framing', 'order'=>0, 'config_project_type_id'=>$this->pt1]);
        $p2 = $phases->insertGetId(['name'=>'FEL 1', 'description'=>'Front End Loading 1', 'order'=>1, 'config_project_type_id'=>$this->pt1]);
        $p3 = $phases->insertGetId(['name'=>'FEL 2', 'description'=>'Front End Loading 2', 'order'=>2, 'config_project_type_id'=>$this->pt1]);
        $p4 = $phases->insertGetId(['name'=>'FEL 3', 'description'=>'Front End Loading 3', 'order'=>3, 'config_project_type_id'=>$this->pt1]);
        $p5 = $phases->insertGetId(['name'=>'Execution', 'description'=>'Execution', 'order'=>4, 'config_project_type_id'=>$this->pt1]);
        $p6 = $phases->insertGetId(['name'=>'Start Up', 'description'=>'Start up', 'order'=>5, 'config_project_type_id'=>$this->pt1]);

        /*
         * this is to be defined by business users
         */
        Schema::create('activity_standards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activity_name');
            $table->longText('activity_introduction');
            $table->longText('activity_description');

            $table->enum('activity_type', ['generic', 'pir', 'pra', 'pll']);
            $table->enum('ppms_type', ['dsp', 'ar', 'sa', 'vmp']);

            /*
             * relationships
             */

            $table->timestamps();
        });

        $activities = DB::table('activity_standards');
        $a1 = $activities->insertGetId(['activity_name'=>'PRA 1', 'activity_type'=>'pra', 'ppms_type'=>'sa']);
        $a2 = $activities->insertGetId(['activity_name'=>'PIR 1', 'activity_type'=>'pir', 'ppms_type'=>'vmp']);
        $a3 = $activities->insertGetId(['activity_name'=>'PLL 1', 'activity_type'=>'pll', 'ppms_type'=>'vmp']);
        $a4 = $activities->insertGetId(['activity_name'=>'Generic Activity', 'activity_type'=>'generic', 'ppms_type'=>'ar']);
        $a5 = $activities->insertGetId(['activity_name'=>'PRA 2', 'activity_type'=>'pra', 'ppms_type'=>'sa']);
        $a6 = $activities->insertGetId(['activity_name'=>'PIR 2', 'activity_type'=>'pir', 'ppms_type'=>'vmp']);
        $a7 = $activities->insertGetId(['activity_name'=>'PLL 2', 'activity_type'=>'pll', 'ppms_type'=>'vmp']);
        $a8 = $activities->insertGetId(['activity_name'=>'Generic Activity', 'activity_type'=>'generic', 'ppms_type'=>'sa']);

        /*
         * associate phases and activity standards
         */
        Schema::create('activity_standards_project_phase', function (Blueprint $table) {
            $table->increments('id');
            /*
             * relationships
             */
            $table->integer('config_project_phase_id');
            $table->integer('activity_standards_id');

            $table->timestamps();
        });

        $activity_standards = DB::table('activity_standards_project_phase');
        $activity_standards->insertGetId(['config_project_phase_id'=>$p1, 'activity_standards_id'=>$a1]);
        $activity_standards->insertGetId(['config_project_phase_id'=>$p1, 'activity_standards_id'=>$a2]);
        $activity_standards->insertGetId(['config_project_phase_id'=>$p1, 'activity_standards_id'=>$a3]);
        $activity_standards->insertGetId(['config_project_phase_id'=>$p1, 'activity_standards_id'=>$a4]);
        $activity_standards->insertGetId(['config_project_phase_id'=>$p2, 'activity_standards_id'=>$a5]);
        $activity_standards->insertGetId(['config_project_phase_id'=>$p2, 'activity_standards_id'=>$a6]);
        $activity_standards->insertGetId(['config_project_phase_id'=>$p2, 'activity_standards_id'=>$a7]);
        $activity_standards->insertGetId(['config_project_phase_id'=>$p2, 'activity_standards_id'=>$a8]);

        /*Schema::create('project_phase_activity', function (Blueprint $table) {
            $table->increments('id');

            $table->string('tag');
            $table->string('name');
            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->integer('project_phase_id');

            $table->timestamps();
        });*/
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->setupProject();
        $this->setupConfig();
        $this->setupTypeAndActivity();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('project');
        Schema::dropIfExists('config_project_type');
        Schema::dropIfExists('config_project_classification');
        Schema::dropIfExists('config_business');
        Schema::dropIfExists('config_currency');
        Schema::dropIfExists('config_contracting_mode');
        Schema::dropIfExists('config_project_type_phase');
        Schema::dropIfExists('config_project_type_phase_activity');
        Schema::dropIfExists('project_attribute');
        Schema::dropIfExists('project_phase');
        //Schema::dropIfExists('project_phase_activity');
        Schema::dropIfExists('config_project_date_type');
        Schema::dropIfExists('project_plant_capacity');
        Schema::dropIfExists('config_project_plant_capacity');
        Schema::dropIfExists('activity_standards');
        Schema::dropIfExists('activity_standards_project_phase');

    }
}
