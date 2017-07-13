<?php

namespace App\Http\Controllers;

use Mail;
use App\Http\Flash;
use App\Models\Mailer;
use Illuminate\Http\Request;
use App\Models\Setting;

class MailController extends Controller
{
	protected $request;
	public function __construct(Request $request)
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$time = date('His');
		$this->request = $request;
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
		Setting::settingMail($setting);

		if ($setting['mail_sent'] <= $setting['setting_mail_per_day']) {
			Mail::send('emails.welcome', $mail, function ($message) use ($mail) {
				$message->to($mail['mail_customer_mail'])->subject($mail['mail_template_subject']);
				$message->cc($mail['mail_template_mail_cc']);
				$message->attach($mail['mail_template_attachment']);

			});

			Mailer::updateStatusMail($mail['mail_id']);
			Setting::updateMailSent($setting['mail_sent'] + 1);
		}
	}

	/**
	 * Edit number of mail sent in date
	 *
	 * @param $time
	 */
	private function editMailSent($time) {
		if ($time >= 070000) {
			Setting::updateMailSent(0);
		}
	}
}
