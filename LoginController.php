<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;
use DB;
class LoginController extends Controller
{

    public function index(){
        return  view('auth.login');
    }

    public function userLogin(Request $request){
    	$data=$request->validate([
    			'email'=>'required|email|exists:users',
    			'password'=>'required|min:6|max:50'

    		]);
        $user_data=User::where('email','=',$data['email'])->get();
   
    if($user_data[0]->status==1){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            
            Session::put('user_id',$user_data[0]->id);
            Session::put('user_email',$user_data[0]->email);

            $role_data=DB::table('roles')
                        ->join('users','users.role_id','=','roles.id')
                        ->select('roles.role')
                        ->where('users.id','=',$user_data[0]->id)
                        ->get();
           
            Session::put('role',$role_data[0]->role);
            return redirect()->route('default');
        }
        else{
            Session::put('error','Wrong Credentials');
            return redirect()->route('mylogin');
        }
    }else{
        return redirect()->back()->with('warning','User account not activated.');
    }
        
        
    }
}
