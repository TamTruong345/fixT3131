<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Main extends Model {

	/**
	 * truncate item is empty
	 *
	 * @param array data
	 * @return array data
	 */
	protected function removeItemIsEmpty($data) {
		foreach ($data as $key => $value) {
			if (empty($value)) {
				unset($data[$key]);
			}
		}
		return $data;
	}

	protected function convertDate($date) {
		return str_replace('/', '-', $date);
	}

	protected function has($data, $key) {
		return (isset($data[$key])) ? true : false;
	}
}

?>