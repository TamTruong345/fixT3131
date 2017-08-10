<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Template;
use App\Models\Mailer;
use App\Models\Sender;
use Illuminate\Http\Request;
use App\Http\Flash;
use Excel, Input;

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
		$data['senders'] = Sender::fetchAll();
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
		if ( isset($data['customers']) && $data['template_id'] != 0 ) {
			$customers = Customer::searchCustomerById($data['customers'])->toArray();
			$template = Template::fetchOne($data['template_id'])->toArray();
			$sender = Sender::fetchOne($data['sender_id']);
			Mailer::create_mail($customers, $template, $sender);
			Customer::updateStatusSendMail($data['customers']);
			flash('Create mail success!')->success();
		} else {
			flash('Create mail fail!')->error();
		}
		return redirect()->route('customer.index');
	}

	/**
	 * Import customer
	 *
	 * @return \Illuminate\Http\RedirectResponse|string
	 */
	public function import() {
		$success = 0;
		$fail = 0;
		$created_at = date('Y-m-d H:i:s');
		$customers = [];
		$data = Excel::selectSheets('customers')->load(Input::file('file_import'), function($reader) {
		})->get(array('company', 'customer', 'email'));
		foreach ($data->toArray() as $key => $val) {
			if ( !empty($val['email']) ) {
				$emails = Customer::checkEmailExist($val['email']);
				if (empty($emails)) {
					$customers[] = [
						'customer_name' => $val['company'],
						'customer_full_name' => $val['customer'],
						'customer_mail' => $val['email'],
						'created_at' => $created_at,
						'customer_deleted' => 0
					];
					$success += 1;
				} else {
					$fail += 1;
				}
			} else {
				$fail += 1;
			}
		}
		try {
			Customer::addMultiRecord($customers);
		} catch (\Exception $e) {
			flash('登録が失敗しました。')->error();
			return redirect()->route('customer.index');
		}
		flash("success: $success, fail: $fail")->success();
		return redirect()->route('customer.index');
	}
}
