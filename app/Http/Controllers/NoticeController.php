<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function show($instructor){
    	$notices = Notice::whereInstructor_id($instructor)->get();
    	return view('announcement', compact('notices'));
    }
}
