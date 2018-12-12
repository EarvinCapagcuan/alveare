<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Level;
Use App\Project;
Use App\Notice;

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

    protected function validator(array $array){
        return Validator::make($array, [
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required|integer',
        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('profile');
    }

    public function profile(){
        if (Auth::User()->level_id == 3) {
            $users = User::orderBy('created_at', 'desc')->get();
            $projects = Project::all();
            $notices = Notice::all();
        }else{
            $users = User::whereSenior_id(Auth::User()->senior_id)->orderBy('created_at', 'desc')->get();
            $projects = Project::whereInstructor_id(Auth::User()->senior_id)->get();
            $notices = Notice::whereInstructor_id(Auth::User()->senior_id)->get();
        }
        return view('profile', compact('users', 'projects', 'notices'));
    }

    public function main(){
        if (Auth::User()->level_id == 3) {
            $users = User::orderBy('created_at', 'desc')->get();
            $projects = Project::all();
            $notices = Notice::all();
        }elseif(Auth::User()->level_id == 2){
            $users = User::whereSenior_id(Auth::User()->id)->orderBy('created_at', 'desc')->get();
            $projects = Project::whereInstructor_id(Auth::User()->id)->get();
            $notices = Notice::whereInstructor_id(Auth::User()->id)->get();
        }elseif(Auth::User()->level_id == 1){
            $users = User::whereSenior_id(Auth::User()->senior_id)->orderBy('created_at', 'desc')->get();
            $projects = Project::whereInstructor_id(Auth::User()->senior_id)->get();
            $notices = Notice::whereInstructor_id(Auth::User()->senior_id)->get();
        }
        return view('main', compact('users', 'projects', 'notices'));
    }

    /*get student list*/

    public function student_batch_list($batch_id){
        $students = User::whereBatch_id($batch_id)->whereLevel_id(1)->get();
        $count = count($students);
        return view('student-list', compact('students', 'count'));   
    }
    /*get instructor list*/

    public function update_account($id, Request $request){
        $this->validate( request(), [
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'contact' => 'required|regex:/[0-9]{11}/',
            'dob' => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->firstname = request('firstname');
        $user->middlename = request('middlename');
        $user->lastname = request('lastname');
        $user->contact = request('contact');
        $user->dob = request('dob');

        if($user->save()){
            echo "success";
        }else{
            echo "error";
        }
    }

    public function search(Request $request){
        $output = "";

        if ($request->search == "") {
            $result = User::all();
        }else{
            $result = User::where('firstname', 'LIKE', '%'.$request->search.'%' )
            ->orWhere('middlename', 'LIKE', '%'.$request->search.'%' )
            ->orWhere('lastname', 'LIKE', '%'.$request->search.'%' )
            ->where('level_id', '!=', Auth::User()->level_id)
            ->get();
        }

        if($result){
            foreach($result as $info){
                $output.='<tr>'.
                '<td>'.ucwords($info->firstname).' '.ucwords($info->lastname).'</td>'.
                '<td>'.$info->email.'</td>'.
                '<td>'.$info->contact.'</td>'.
                '<td>'.$info->batch->batch_name.'</td>';
                if(Auth::User()->level_id == 3){
                    $output.='<td><a href="#edit-modal-'.$info->id.'" class="uk-button uk-button-secondary" uk-tooltip="title: Edit" uk-toggle><i uk-icon="icon:file-edit"></i></a></td></tr>';
                }
            }
        }
        return response($output);
    }

    public function accounts($q){
        if($q == 3){
            $users = User::where('level_id', '!=', Auth::User()->level_id)->get();
        }else{
            $users = User::whereSenior_id(Auth::User()->id)->get();
        }
        return view('users-list', compact('users'));
    }

    public function delete($id, Request $request){
        $user = User::findOrFail($id);
        
        if ($user->delete()) {
            echo "success";
        }else{
            echo "error";
        }
    }

}