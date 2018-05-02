<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\User;
use Validator;
use DB;
use App\Student;
use App\Faculty;
class HomeController extends Controller
{
    public function aboutUs(){
        return view('aboutUs');
    }

    public function contactUs(){
        return view('contactUs');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/


    public function create(Request $request){
 /*       create table persons(name varchar(50),street_number varchar(10),route varchar(50),locality varchar(50),state varchar(50),postal_code varchar(10), country varchar(50));*/
       $person= DB::table('persons')->insert([
            'name'=>$request->name,
            'street_number'=>$request->street_number,
            'route'=>$request->route,
            'locality'=>$request->locality,
            'state'=>$request->state,
            'postal_code'=>$request->postal_code,
            'country'=>$request->country
        ]);
       return back()->with('success','Record uploaded successfully');


    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('home');
        return redirect()->route('default');
    }
    /**
     * Show the default page.
     *
     * @return \Illuminate\Http\Response
     */

    public function defaultPage(){
        return view('byDefault');
    }

    /*
    *rendering change password form
    */
    public function displayChangePassword(){
        return view('auth.changePassword');
    }


    public function changePassword(Request $request){
        if(!(Hash::check($request->get('current_password'),Auth::user()->password))){
            return redirect()->back()->with("error","Your current password does not matches with the password you provided earlier.");
        }

        if(strcmp($request->get('current_password'),$request->get('new_password'))==0){
            return redirect()->back()->with("error","Your current password can not be same as your previous password");
        }

        $validateData=$request->validate([
                'current_password'=>'required',
                'new_password'=>'required|string|min:6|confirmed'
            ]);

        $user=Auth::user();
        $user->password=bcrypt($request->get('new_password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully");

    }

    /*
    *Displaying my Profile Page
    */
    public function myProfile(){
        $user_id=Auth::user()->id;
        $student=Student::where('user_id','=',$user_id)->get();
        /*echo "<pre>";
        print_r($student_data);
        exit;*/

        $faculty=Faculty::where('user_id','=',$user_id)->get();
        /*echo "<pre>";
        print_r($faculty->count());
        echo "<br>";
        print_r($student->count());
        exit;*/

        if($student->count())
        {   
            $student_data=DB::table('students')
                        ->join('cities','cities.id','=','students.city_id')
                        ->join('states','states.id','=','students.state_id')
                        ->join('users','users.id','=','students.user_id')
                        ->join('courses','courses.id','=','students.course_id')
                        ->select('users.*','students.address','students.contact','students.registration_date','students.session','students.pin','students.father_name','students.mother_name','cities.city_name','states.state_name','courses.course')
                        ->where('users.id','=',Auth::user()->id)
                        ->get();
           /* echo "<pre>";
            print_r($student_data);
            exit;*/
            return view('myProfile')->with('user_data',$student_data[0]);    
        }
        elseif ($faculty->count()) 
        {
            $faculty_data=DB::table('faculties')
                        ->join('cities','cities.id','=','faculties.city_id')
                        ->join('states','states.id','=','faculties.state_id')
                        ->join('users','users.id','=','faculties.user_id')
                        ->join('departments','departments.id','=','faculties.department_id')
                        ->select('users.*','faculties.address','faculties.department','faculties.contact','faculties.doj','faculties.father_name','faculties.mother_name','faculties.pin','cities.city_name','states.state_name')
                        ->where('users.id','=',Auth::user()->id)
                        ->get();
          
            return view('myProfile')->with('user_data',$faculty_data[0]);   
        }
        else{
            $user_data=User::find(Auth::user()->id);
            return view('myProfile')->with('user_data',$user_data);
        }


        $user_data=User::find(Auth::user()->id);
        return view('myProfile')->with('user_data',$user_data);
    }

    public function changeImage(Request $request){
        $validatedData = $request->validate([
            'image'=>'required|max:500|mimes:jpeg,png,jpg',
            'id'=>'',
        ]);

        /*echo $validatedData['image'];
        exit;*/
        $image=$request->image;
        $fileName = time().'.'.$validatedData['image']->getClientOriginalExtension();
        $validatedData['image']->move(public_path('images'), $fileName);
        /*echo $fileName;
        exit;*/
        $user=User::find($validatedData['id']);
        if($user->count()){
            $user->image_title=$fileName;
            $user->save();
            return redirect()->back()->with("success","Image uploaded successfully");
        }else{
            return redirect()->back()->with("error","Image not uploaded, please try again");
        }

    }
    
}

