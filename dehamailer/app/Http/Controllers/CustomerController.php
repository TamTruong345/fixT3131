<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Flash;

class CustomerController extends Controller
{
    protected $errors = [];
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /*
    * Display a listing of customers.
    *
    * @return Response
    */
    
	public function index() {
		$customers = Customer::getList();
		return view('customers.index', array('customers' => $customers));
	}
	
	/*
	* Store a new customer
	*
	* @return Response
	*/
	public function store() {
		$data = $this->request->toArray();
		Customer::addNewRecord($data);
		flash('Add customer success!');
		return redirect()->route('customer.index');
	}
	
	/*
	* edit customer
	* 
	* @return Response
	*/
	public function update() {
		$data = $this->request->toArray();
		Customer::editRecord($data);
		flash('Edit customer success!');
		return redirect()->route('customer.index');
	}
	
	/*
	* Destroy customer
	*
	* @param int customer_id
	*/
	public function destroy($customer_id) {
		Customer::deleteCustomer($customer_id);
	}
	
	
	public function show($customer_id) {
		$customerDetail = Customer::fetchOne($customer_id);
		return json_encode($customerDetail);
	}
}
