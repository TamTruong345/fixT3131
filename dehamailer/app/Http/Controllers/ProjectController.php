<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
use Illuminate\Http\Request;

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
        $data['customers'] = Customer::fetchAll();
        /*echo '<pre>';
            print_r($data['customers']);
        echo '</pre>';
        die(0);*/
        $data['projects'] = Project::getList($data ['conditions']);
        return view('projects.index', array('data' => $data));
    }

    /**
     * Store a new customer
     *
     * @return Response
     */
    public function store() {

    }

    /**
     * edit project
     *
     * @return Response
     */
    public function update() {

    }

    /**
     * Destroy project
     *
     * @param int project_id
     */
    public function destroy() {

    }

    /**
     * Get Project Detail
     *
     * @param int project_id
     * @return json customer detail
     */
    public function show() {

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
     * Reset condition search project
     */
    public function reset() {
        $this->request->session()->forget('search_project');
    }


}
