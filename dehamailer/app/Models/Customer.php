<?php

namespace App\Models;

class Customer extends Main {
	/**
	 * The table associated with the extends.
	 *
	 * @var string
	 */
	protected $table = 'customers';
	protected $primaryKey = 'customer_id';

	/**
	 * Get a listing of customer with condition
	 *
	 * @return array Response
	 */
	protected function getList($condition) {
		$condition = $this->removeItemIsEmpty($condition);
		$condition = $this->makeConditionSearchForCustomer($condition);
		return $query = $this->where($condition)
					->paginate(10);
	}

	/**
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

	/**
	 * Delete item of customers table
	 *
	 * @param int customer_id
	 */
	protected function deleteCustomer($customer_id) {
		$this->where('customer_id', $customer_id)
			->update(['customer_deleted' => 1]);
	}

	/**
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

	/**
	 * Search customer by id
	 *
	 * @param int customer_id
	 * @return array customer detail
	 */
	protected function fetchOne($customer_id) {
		return $this->where('customer_id', $customer_id)->first();
	}

	/**
	 * Make condition search for customer
	 *
	 * @param $condition
	 * @return array
	 */
	private function makeConditionSearchForCustomer($condition) {
		$predicates = [];
		$predicates[] = ['customer_deleted', '=', '0'];
		if ($this->has($condition, 'customer_name')) {
			$predicates[] = ['customer_name', '=', $condition['customer_name']];
		}
		if ($this->has($condition, 'customer_mail')) {
			$predicates[] = ['customer_mail', '=', $condition['customer_mail']];
		}
		if ($this->has($condition, 'created_at_from')) {
			$predicates[] = ['created_at', '>=', $this->convertDate($condition['created_at_from'])];
		}
		if ($this->has($condition, 'created_at_to')) {
			$predicates[] = ['created_at', '<=', $this->convertDate($condition['created_at_to'])];
		}
		if ($this->has($condition, 'customer_last_sent_mail_from')) {
			$predicates[] = ['customer_last_sent_mail', '>=', $this->convertDate($condition['customer_last_sent_mail_from'])];
		}
		if ($this->has($condition, 'customer_last_sent_mail_to')) {
			$predicates[] = ['customer_last_sent_mail', '<=', $this->convertDate($condition['customer_last_sent_mail_to'])];
		}
		
		return $predicates;
	}
}

?>