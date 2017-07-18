<?php

namespace App\Http\Controllers;

use Mail;
use App\Http\Flash;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Sender;

class SettingController extends Controller
{
	/*
	 * Display a listing of setting.
	 *
	 * @return Response
	 */

	protected $request;
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function index() {
		$data['settings'] = Setting::fetchOne();
		$data['senders'] = Sender::fetchAll();
		return view('setting', array('data' => $data));
	}

	/**
	 * edit setting
	 *
	 * @return Response
	 */
	public function update() {
		$data = $this->request->toArray();
		Setting::editRecord($data);
		flash('Edit setting success!');
		return redirect()->route('setting.index');
	}
}
