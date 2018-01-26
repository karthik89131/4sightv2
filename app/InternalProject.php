<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;


class InternalProject extends Model
{

	public static function Test() {
		return array("Volvo", "BMW", "Toyota");
	}

	public static function stdtime() {
		return date('Y-m-d H:i:s');
	}
	
	public static function addproject(array $data = array()) {
		$datetime = self::stdtime();

		$insertid = DB::table('internal_projects')->insertGetId(
			[
				'created_date' => $datetime,
				'modified_date' => $datetime,
				'name' => $data['name'],
				'start_date' => $data['start_date'],
				'end_date' => $data['end_date'],
				'description' => $data['description']
			]
		);

		$result = array(
			'id' => $insertid,
			'created_date' => $datetime,
			'modified_date' => $datetime,
			'name' => $data['name'],
			'start_date' => $data['start_date'],
			'end_date' => $data['end_date'],
			'description' => $data['description'],
			'tasks' => 0,
			'issues' => 0
		);
		
		return $result;
	}

	public static function delproject($id) {
		$deleted_projectes = DB::table('internal_projects')->where('id', '=', $id)->delete();
		$deleted_tasks = DB::table('internal_tasks')->where('projectid', '=', $id)->delete();
		$deleted_issues = DB::table('internal_issues')->where('projectid', '=', $id)->delete();
		//return array('projects' => $deleted_projects, 'tasks' => $deleted_tasks, 'issues' => $deleted_issues);
		return 1;
	}
	
	public static function getprojects() {
		//$projects = DB::table('internal_projects')->get();
		$projects = DB::select("SELECT project.*, IFNULL(task.tasks, 0) AS tasks, IFNULL(issue.issues, 0) AS issues FROM internal_projects AS project LEFT JOIN (SELECT count(*) AS tasks, projectid FROM internal_tasks GROUP BY projectid) AS task ON project.id = task.projectid LEFT JOIN (SELECT count(*) AS issues, projectid FROM internal_issues GROUP BY projectid) AS issue ON project.id = issue.projectid");
		return $projects;
	}
}
