<?php

namespace App\Http\Controllers;

use App\Models\Sender;
use Illuminate\Http\Request;
use App\Http\Flash;

class SenderController extends Controller
{
	protected $request;
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Store a new sender
	 *
	 * @return Response
	 */
	public function store() {
		$data = $this->request->toArray();
		Sender::addNewRecord($data);
		flash('Add sender success!')->success();
		return redirect()->route('setting.index');
	}

	/**
	 * edit sender
	 *
	 * @return Response
	 */
	public function update() {
		$data = $this->request->toArray();
		Sender::editRecord($data);
		flash('Edit sender success!');
		return redirect()->route('setting.index');
	}

	/**
	 * Destroy sender
	 *
	 * @param int sender_id
	 */
	public function destroy($sender_id) {
		Sender::deleteSender($sender_id);
	}

	/**
	 * Get Sender Detail
	 *
	 * @param int sender_id
	 * @return json sender detail
	 */
	public function show($sender_id) {
		$senderDetail = Sender::fetchOne($sender_id);
		return json_encode($senderDetail);
	}
}
