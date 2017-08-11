<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
use Illuminate\Http\Request;
use Config;

class ProjectController extends Controller
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of customers.
     *
     * @return Response
     */

    public function index() {

        $data = ['conditions' => []];
        if ($this->request->session()->has('search_project')) {
            $data ['conditions'] = $this->request->session()->get('search_project');
        }
        $data['members'] = Config::get('member.members');
        $data['customers'] = Customer::fetchAll();
        $data['projects'] = Project::getList($data ['conditions']);
        return view('projects.index', array('data' => $data));
    }
    public function store() {
        $data = $this->request->toArray();
        Project::addNewRecord($data);
        flash('Add project success!')->success();
        return redirect()->route('project.index');
    }

    /**
     * Reset condition search project
     */
    public function reset() {
        $this->request->session()->forget('search_project');
    }
}
