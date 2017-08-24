<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
use App\Models\Member;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\DB;

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
        $data['list_status_selected'] = [];
        if ($this->request->session()->has('search_project')) {
            $data ['conditions'] = $this->request->session()->get('search_project');
        }

        if ( isset($data['conditions']['project_status']) ) {
            $data['list_status_selected'] = $data['conditions']['project_status'];
        }

        $data['members'] = Member::fetchAll();
        $data['customers'] = Customer::fetchAll();
        $data['projects'] = Project::getList($data ['conditions']);
        return view('projects.index', array('data' => $data));

    }
    public function store() {
        $data = $this->request->toArray();
        $dataCus = [];
        $dataCus['customer_name'] = $data['customer_name'];

        $dataMem = [];
        $dataMem['member_name'] = $data['member_name'];

        if(empty($data['project_customer_id'])) {
            $data['project_customer_id'] = Customer::addNewRecord($dataCus);
        }
        if(empty($data['project_member_id'])) {
            $data['project_member_id'] = Member::addNewRecord($dataMem);
        }

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
        $dataCus = [];
        $dataCus['customer_name'] = $data['customer_name'];

        $dataMem = [];
        $dataMem['member_name'] = $data['member_name'];

        if(empty($data['project_customer_id'])) {
            $data['project_customer_id'] = Customer::addNewRecord($dataCus);
        }
        if(empty($data['project_member_id'])) {
            $data['project_member_id'] = Member::addNewRecord($dataMem);
        }

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

    /**
     * Edit last memo
     */
    public function updateLastMemo() {
        $project_id = $this->request->get('project_id');
        $project_last_memo = $this->request->get('project_last_memo');
        $project = Project::find($project_id);
        $project->project_last_memo = $project_last_memo;
        $project->save();
    }

    public function orderBy($project_name,$project_customer_id)   {
        return  [
            'project_name' => $project_name,
            'project_customer_id' => $project_customer_id
        ];
    }
}
