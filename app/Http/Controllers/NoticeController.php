<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\User;
Use App\Notice;

class NoticeController extends Controller
{
	public function post($id, Request $request){

		$this->validate(request(), [
			'title' => 'required',
			'content' => 'required',
		]);

		$notices = new Notice;

		$notices->title = request('title');
		$notices->content = request('content');
		$notices->instructor_id = Auth::User()->id;

		if($notices->save()){
			echo "success";
		}else{
			echo "errorrrr";
		}
	}

	public function edit($id, Request $request){
		$notices = Notice::findOrFail($id);

		$this->validate(request(), [
			'title' => 'required',
			'content' => 'required',
		]);

		$notices->title = request('title');
		$notices->content = request('content');
		$notices->instructor_id = Auth::User()->id;

		if($notices->save()){
			echo "success";
		}else{
			echo "error";
		}
	}

    public function show($instructor){
    	$user = User::findOrFail($instructor);
    	if ($user->level_id == 3) {
    		$notices = Notice::orderBy('created_at', 'desc')->paginate(10);	
    	}elseif($user->level_id == 2){
    		$notices = Notice::whereInstructor_id($instructor)->orderBy('created_at', 'desc')->paginate(10);
    	}else{
    		$notices = Notice::whereInstructor_id($user->senior_id)->orderBy('created_at', 'desc')->paginate(10);
    	}
    	return view('announcement', compact('notices'));
    }
}
