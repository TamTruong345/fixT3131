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
        $data['projects'] = Project::getList($data ['conditions']);
        return view('projects.index', array('data' => $data));
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
