<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Batch;
use App\User;

class BatchController extends Controller
{
	public function startBatch(){
		$batches = Batch::latest()->get();
		$users = User::all();
		return view('batch-list', compact('batches', 'users'));
	}

	public function create(Request $request){
		$this->validate(request(), [
			'batchName' => 'required|unique:batches,batch_name',
			'slots' => 'required|integer|min:30|max:45',
		]);

		$batch = new Batch;

		$batch->batch_name = request('batchName');
		$batch->slot = request('slots');

		if ($batch->save()) {
			echo "success";
		}else{
			echo "error";
		}
	}

	public function listBatch($id){
		$batches = Batch::findOrFail($id);
		return $batches;
	}

	public function studentList($batch_id){
		$users = User::whereBatch_id($batch_id)->orderBy('level_id', 'desc')->get();
		echo $users;
	}
}