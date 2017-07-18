<?php

namespace App\Models;
use Config;

class Setting extends Main {
	/**
	 * The table associated with the extends.
	 *
	 * @var string
	 */
	protected $table = 'setting';
	protected $primaryKey = 'setting_id';

	/**
	 * Setting mail
	 *
	 * @param array setting
	 */
	protected function settingMail($setting, $mail) {
		$configMail = [
			'driver' => $setting['setting_driver'],
			'host' => $setting['setting_host'],
			'port' => $setting['setting_port'],
			'from' => [
				'address' => $mail['mail_sender_username'],
				'name' => $mail['mail_sender_from_name']
			],
			'encryption' => $setting['setting_encryption'],
			'username' => $mail['mail_sender_username'],
			'password' => $mail['mail_sender_password'],
		];
		Config::set('mail', $configMail);
	}

	/**
	 * Search setting by status
	 *
	 * @return array setting detail
	 */
	protected function fetchOne() {
		return $this->where('setting_deleted', 0)->first()->toArray();
	}

	/**
	 * Edit a record with by id
	 *
	 * @param $data
	 */
	protected function editRecord($data) {
		unset($data['_token']);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->where('setting_id', $data['setting_id'])
			->update($data);
	}
}

?>