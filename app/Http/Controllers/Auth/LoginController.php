<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function authenticated($request , $user){
    $user->update([
        'last_login_at' => Carbon::now()->toDateTimeString(),
        'last_login_ip' => $request->getClientIp()
    ]);

    if($user->level_id==3){
        return redirect('main-0');
    }elseif($user->level_id==2){
        return redirect('main-'.$user->id);
    }elseif($user->level_id==1){
        return redirect('main-'.$user->id);
    }

}
/*    protected $redirectTo = '/home';
*/
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
