<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Notice;

class NoticeController extends Controller
{
	public function post($id, Request $request){
		$notices = new Notice;

		$notices->title = $request->title;
		$notices->content = $request->content;
		$notices->instructor_id = $id;

		if($notices->save()){
			echo "success";
		}else{
			echo "errorrrr";
		}
	}

	public function edit($id, Request $request){
		$notice = Notice::findOrFail($id);
		$notice->title = $request->title;
		$notice->content = $request->content;
		if($notice->save()){
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
    		$notices = Notice::whereInstructor_id($instructor)->orderBy('created_at', 'asc')->paginate(10);
    	}else{
    		$notices = Notice::whereInstructor_id($user->senior_id)->orderBy('created_at', 'asc')->paginate(10);
    	}
    	return view('announcement', compact('notices'));
    }
}
