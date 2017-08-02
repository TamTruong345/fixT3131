<?php

namespace App\Models;

class Mailer extends Main {
	/**
	 * The table associated with the extends.
	 *
	 * @var string
	 */
	protected $table = 'mails';
	protected $primaryKey = 'mail_id';

	/**
	 * Create mail
	 * 
	 * @param $customers
	 * @param $template
	 */
	protected function create_mail($customers, $template, $sender) {
		$mails = [];
		foreach ($customers as $cus) {
			$tmp_template = $template;
			$tmp_template['template_content'] = str_replace('[COMPANY]', $cus['customer_name'], $tmp_template['template_content']);
			$tmp_template['template_content'] = str_replace('[FULLNAME]', $cus['customer_full_name'], $tmp_template['template_content']);
			$mails[] = [
				'created_at' => date('Y-m-d H:i:s'),
				'mail_customer_id' => $cus['customer_id'],
				'mail_customer_name' => $cus['customer_name'],
				'mail_customer_full_name' => $cus['customer_full_name'],
				'mail_customer_mail' => $cus['customer_mail'],
				'mail_template_id' => $tmp_template['template_id'],
				'mail_template_subject' => $tmp_template['template_subject'],
				'mail_template_content' => $tmp_template['template_content'],
				'mail_template_attachment' => $tmp_template['template_attachment'],
				'mail_template_mail_cc' => $tmp_template['template_mail_cc'],
				'mail_sender_id' => $sender['sender_id'],
				'mail_sender_username' => $sender['sender_username'],
				'mail_sender_password' => $sender['sender_password'],
				'mail_sender_from_name' => $sender['sender_from_name'],
				'mail_status' => 0,
			];
		}
		$this->insert($mails);
	}

	/**
	 * Get first mail from database
	 *
	 * @return mixed
	 */
	protected function getFirstList() {
		$mail = $this->where('mail_status', 0)->limit(1)->get()->toArray();
		$mail = $mail[0];
		$mail['mail_template_content'] = nl2br($mail['mail_template_content']);
		return $mail;
	}

	/**
	 * Edit status of mail
	 *
	 * @param $mail_id
	 */
	protected function updateStatusMail($mail_id, $status) {
		$this->where('mail_id', $mail_id)
			->update(['mail_status' => $status]);
	}

	/**
	 * Edit all status
	 * 
	 * @param $status
	 */
	protected function updateAllStatus($status) {
		$this->where('mail_status', 4)
			->update(['mail_status' => $status]);
	}
}

?>