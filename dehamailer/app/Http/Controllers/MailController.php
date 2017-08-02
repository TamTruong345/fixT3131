<?php

namespace App\Http\Controllers;

use Mail;
use App\Http\Flash;
use App\Models\Mailer;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Customer;
use App\Models\Sender;

class MailController extends Controller
{
	protected $request;
	public function __construct(Request $request)
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$time = date('His');
		$this->request = $request;
		$this->editStatusMail($time);
		$this->editMailSent($time);
	}

	/**
	 * Send mail.
	 *
	 * @return Response
	 */
	public function send_mail() {
		$mail = Mailer::getFirstList();
		$setting = Setting::fetchOne();
		Setting::settingMail($setting, $mail);
		$sender = Sender::fetchOne($mail['mail_sender_id']);
		Mailer::updateStatusMail($mail['mail_id'], 4);

		if ($sender['sender_mail_sent'] <= $setting['setting_mail_per_day']) {
			Mailer::updateStatusMail($mail['mail_id'], 3);
			Mail::send('emails.welcome', $mail, function ($message) use ($mail) {
				$message->to($mail['mail_customer_mail'])->subject($mail['mail_template_subject']);
				if (!empty($mail['mail_template_mail_cc'])) {
					$cc_mail = explode(',', $mail['mail_template_mail_cc']);
					foreach ($cc_mail as $cc) {
						$message->cc(trim($cc));
					}
				}
				if (!empty($mail['mail_template_attachment'])) {
					$message->attach($mail['mail_template_attachment']);
				}
			});

			Mailer::updateStatusMail($mail['mail_id'], 1);
			Sender::updateMailSent($sender['sender_id'], $sender['sender_mail_sent'] + 1);
			Customer::editRecord(
				[
					'customer_id' => $mail['mail_customer_id'],
					'customer_last_sent_mail' => date('Y-m-d H:i:s'),
					'customer_mail_status' => null
				]
			);
		}
	}

	/**
	 * Edit number of mail sent in date
	 *
	 * @param $time
	 */
	private function editMailSent($time) {
		if ($time >= 70000 && $time <= 70059) {
			Sender::updateAllMailSent(0);
		}
	}

	/**
	 * Edit status mail send
	 * @param $time
	 */
	private function editStatusMail($time) {
		if ($time >= 65900 && $time <= 65959) {
			Mailer::updateAllStatus(0);
		}
	}
}
