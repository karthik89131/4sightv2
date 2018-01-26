<?php namespace App\Http\Controllers;
use App\DatatableConfig;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\PageModel;

class PagesJSONController extends Controller {

	public function __construct()
	{

	}

	/**
	 * Return a ng2 smart table object to display table data
	 *
	 * @return Response
	 */
	public function getTable($id){
        $tables = DatatableConfig::getTables($id);
        return new Response($tables);
    }

    /**
     * updates database with the request generated
     * @param Request
     * @return Response
     */
    public function setTable(Request $request, $table_name){
        $req = $request->input();

        $tables = DatatableConfig::setTables($table_name, $req);
        return new Response($tables);
    }

    /**
     * get all tables
     * @param Request
     * @return Response
     */
    public function listTables(){
        $tables = DatatableConfig::listTables();
        return new Response($tables);
    }
}
