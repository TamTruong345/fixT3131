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

    /**
     * Get Project Detail
     *
     * @param int project_id
     * @return json project detail
     */
    public function show($project_id) {
        $projectDetail = Project::fetchOne($project_id);
        return json_encode($projectDetail);
    }

    /**
     * edit project
     *
     * @return Response
     */

    public function update() {
        $data = $this->request->toArray();
        Project::editRecord($data);
        flash('Edit project success!');
        return redirect()->route('project.index');

    }

    /**
     * Destroy project
     *
     * @param int project_id
     */
    public function destroy($project_id) {
        Project::deleteProject($project_id);
    }

    /**
     * Set condition search
     */
    public function search() {
        $condition = $this->request->toArray();
        unset($condition['_token']);
        $this->request->session()->put('search_project', $condition);
        return redirect()->route('project.index');
    }
}
