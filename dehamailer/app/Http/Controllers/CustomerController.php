<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Template;
use App\Models\Mailer;
use Illuminate\Http\Request;
use App\Http\Flash;

class CustomerController extends Controller
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
		if ($this->request->session()->has('search_customer')) {
			$data ['conditions'] = $this->request->session()->get('search_customer');
		}
		$data['customers'] = Customer::getList($data ['conditions']);
		$data['templates'] = Template::fetchAll();
		return view('customers.index', array('data' => $data));
	}
	
	/**
	* Store a new customer
	*
	* @return Response
	*/
	public function store() {
		$data = $this->request->toArray();
		Customer::addNewRecord($data);
		flash('Add customer success!')->success();
		return redirect()->route('customer.index');
	}
	
	/**
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
	
	/**
	* Destroy customer
	*
	* @param int customer_id
	*/
	public function destroy($customer_id) {
		Customer::deleteCustomer($customer_id);
	}
	
	/**
	 * Get Customer Detail
	 * 
	 * @param int customer_id
	 * @return json customer detail
	 */
	public function show($customer_id) {
		$customerDetail = Customer::fetchOne($customer_id);
		return json_encode($customerDetail);
	}

	/**
	 * Set condition search
	 */
	public function search() {
		$condition = $this->request->toArray();
		unset($condition['_token']);
		$this->request->session()->put('search_customer', $condition);
		return redirect()->route('customer.index');
	}

	/**
	 * Reset condition search customer
	 */
	public function reset() {
		$this->request->session()->forget('search_customer');
	}

	/**
	 * Create mail
	 */
	public function create_mail() {
		$data = $this->request->toArray();
		if ( isset($data['customers']) ) {
			$customers = Customer::searchCustomerById($data['customers'])->toArray();
			$template = Template::fetchOne($data['template_id'])->toArray();
			Mailer::create_mail($customers, $template);
			flash('Create mail success!')->success();
		} else {
			flash('Create mail fail!')->error();
		}
		return redirect()->route('customer.index');
	}
}
