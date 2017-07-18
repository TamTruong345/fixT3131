<?php

namespace App\Models;

class Sender extends Main {
	/**
	 * The table associated with the extends.
	 *
	 * @var string
	 */
	protected $table = 'senders';
	protected $primaryKey = 'sender_id';

	/**
	 * Get list sender
	 *
	 * @return array Response
	 */
	protected function fetchAll() {
		return $this->where('sender_deleted', '=', 0)->paginate(50);
	}
	
	/**
	 * Get sender by id
	 *
	 * @return array sender detail
	 */
	protected function fetchOne($sender_id) {
		return $this->where(
			[
				'sender_id' => $sender_id,
				'sender_deleted' => 0
			]
		)->first()->toArray();
	}

	/**
	 * Create a new sender
	 *
	 * @param $data
	 * @return mixed
	 */
	protected function addNewRecord($data) {
		unset($data['_token']);
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['sender_deleted'] = 0;
		return $this->insertGetId($data);
	}

	/**
	 * Edit a record with by id
	 * 
	 * @param $data
	 */
	protected function editRecord($data) {
		unset($data['_token']);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->where('sender_id', $data['sender_id'])
			->update($data);
	}

	/**
	 * update field sender_deleted with by id
	 * 
	 * @param $sender_id
	 */
	protected function deleteSender($sender_id) {
		$this->where('sender_id', $sender_id)
			->update(['sender_deleted' => 1]);
	}
}

?>