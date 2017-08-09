<?php

namespace App\Http\Controllers;

use App\Project;
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
        return view('projects.index');
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
     * @param int customer_id
     * @return json customer detail
     */
    public function show() {

    }

    /**
     * Set condition search
     */
    public function search() {
    }

    /**
     * Reset condition search project
     */
    public function reset() {

    }

}
