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
	protected function settingMail($setting) {
		Config::set('mail.driver', $setting['setting_driver']);
		Config::set('mail.host', $setting['setting_host']);
		Config::set('mail.port', $setting['setting_port']);
		Config::set('mail.from.address', $setting['setting_username']);
		Config::set('mail.from.name', $setting['setting_from_name']);
		Config::set('mail.encryption', $setting['setting_encryption']);
		Config::set('mail.username', $setting['setting_username']);
		Config::set('mail.password', $setting['setting_password']);
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
	 * Edit mail sent
	 */
	protected function updateMailSent($number) {
		$this->where('setting_deleted', 0)->update(['mail_sent' => $number]);
	}
}

?>