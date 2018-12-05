<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Level;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function main(){
        return view('main');
    }
    public function student(){
        return view('student-profile');
    }

    public function instructor(){
        return view('instructor-profile');   
    }

    public function manager(){
        return view('manager-profile');
    }

    /*get student list*/
    public function student_list(){
        $students = User::whereLevel_id(1)->get();
        $count = count($students);
        return view('student-list', compact('students', 'count'));
    }
    public function student_batch_list($batch_id){
        $students = User::whereBatch_id($batch_id)->whereLevel_id(1)->get();
        $count = count($students);
        return view('student-list', compact('students', 'count'));   
    }
    /*get instructor list*/
    public function instructor_list(){
        $instructors = User::whereLevel_id(2)->get();
        $count = User::all()->count();
        return view('instructor-list', compact('instructors', 'count'));
    }

    public function update_account($id, Request $request){
        $user = User::findOrFail($id);

        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->contact = $request->contact;

        if($request->level != 3){
            $user->batch_id = $request->batch_id;
            $user->senior_id = $request->handler;
        }

        if($user->save()){
            echo "success";
        }else{
            echo "error";
        }
    }

    public function search($val, Request $request){
        $result = User::where('firstname', 'LIKE', '%' . $val . '%' )->orWhere('middlename', 'LIKE', '%' . $val . '%' )->orWhere('lastname', 'LIKE', '%' . $val . '%' )->orWhere('email', 'LIKE', '%' . $val . '%' )->get();
        return $result;
    }
}