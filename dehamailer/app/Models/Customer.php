<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model {
	/**
	 * The table associated with the extends.
	 *
	 * @var string
	 */
	protected $table = 'customers';
	protected $primaryKey = 'customer_id';

	/*
	 * Get a listing of customer with condition
	 *
	 * @return array Response
	 */
	protected function getList() {
		return $this->where('customer_deleted', '=', 0)->paginate(10);
	}

	/*
	 * Add one record into customer table
	 *
	 * @param array Data import
	 * @return int customer_id
	 */
	protected function addNewRecord($data) {
		unset($data['_token']);
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['customer_deleted'] = 0;
		return $this->insertGetId($data);
	}

	/*
	 * Delete item of customers table
	 *
	 * @param int customer_id
	 */
	protected function deleteCustomer($customer_id) {
		$this->where('customer_id', $customer_id)
			->update(['customer_deleted' => 1]);
	}

	/*
	 * Edit record of customers tables
	 *
	 * @param array data update
	 */
	protected function editRecord($data) {
		unset($data['_token']);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->where('customer_id', $data['customer_id'])
			->update($data);
	}

	/*
	 * Search customer by id
	 *
	 * @param int customer_id
	 * @return array customer detail
	 */
	protected function fetchOne($customer_id) {
		return $this->where('customer_id', $customer_id)->first();
	}
}

?>