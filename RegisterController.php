<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\VerifyUser;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    protected function registered(Request $request, $user){
        $this->guard()->logout();
        return redirect('/login')->with('active_status','We sent you an activation code.check your email and click on the link to verify.');
    }

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'role'=>'',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'dob'=>'required|date',
            'image'=>'max:100|mimes:jpeg,png,jpg',
            'password' => 'required|string|min:6|confirmed',
            'status'=>''
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $fileName = time().'.'.$data['image']->getClientOriginalExtension();
        $data['image']->move(public_path('images'), $fileName);

        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'image_title'=>$fileName,
            'dob'=>$data['dob'],
            'password' => bcrypt($data['password']),
            'role_id'=>$data['role'],
            'status' =>$data['status']
        ]);

        $verifyUser=VerifyUser::create([
            'user_id'=>$user->id,
            'token'=>str_random(40)
            ]);

        //Mail::to($data['email'])->send(new VerifyMail($user));
        Mail::to('yashrautela1@gmail.com')->send(new VerifyMail($user));
        return $user;
    }
    public function verifyUser($token){
        $verifyUser=VerifyUser::where('token',$token)->first();
        if(isset($verifyUser)){
            $user=$verifyUser->user;
            // echo "<pre>";
            // print_r($user);
            // exit;
            
            /*print_r($user->status);
            exit;*/
            if(!$user->status){
                $verifyUser->user->status=1;
                $verifyUser->user->save();
                Mail::to($user['email'])->send(new WelcomeMail($user));
                

                $active_status="your email is verfied, Now you can login to the system.";
                 return redirect('/login')->with('active_status',$active_status);

            }else{
                $active_status="Your email is already verified. You can now login.";
                return redirect('/login')->with('active_status',$active_status);
            }
        }else{
            return redirect('/login')->with('warning','Sorry your email cannot be identified.');
        }
        return redirect('/login')->with('active_status',$active_status);
    }
}

