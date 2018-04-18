<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use DateTime;
use App\Course;
use App\User;
use DB;

class StudentController extends Controller
{

    /*
    *Rendering student data to the admin Panel
    */
    public function getStudent(){
        /*$student_data=DB::table('users')->whereIn('id',function($query){
            $query->select('user_id')->from('students');
            })
        ->get();*/
        $student_data=User::where('role_id','=',3)->get();

        if($student_data->count()){
            return view('admin.students')->with('data',$student_data);    
        }
        else{
            return view('admin.noStudent');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crud.student');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data=$request->validate([
            'user_id'=>'required|integer',
            'address'=>'required|string',
            'city'=>'required|integer',
            'state'=>'required|integer',
            'contact'=>'required|numeric',
            'course_id'=>'required|integer',
            'registration_date'=>'required|date',
            'pin'=>'required|numeric',
            'father'=>'string',
            'mother'=>'string'
            ]);
        /*echo "hello";
        exit;*/
        $course=Course::where('id','=',$request->course_id)->get();
       
        $duration=$course[0]->duration;
        
        $date = DateTime::createFromFormat("Y-m-d", $request->registration_date);
        $year=$date->format("Y");
        $lastyear=$year+$duration;
        $session=$year."-".$lastyear;
        
        $student_data=new Student;
        $student_data->user_id=$request->user_id;
        $student_data->address=$request->address;
        $student_data->city_id=$request->city;
        $student_data->state_id=$request->state;
        $student_data->contact=$request->contact;
        $student_data->course_id=$request->course_id;
        $student_data->registration_date=$request->registration_date;
        $student_data->session=$session;
        $student_data->pin=$request->pin;
        $student_data->father_name=$request->father;
        $student_data->mother_name=$request->mother;
        $student_data->save();
        if($student_data){
            return redirect()->back()->with("success","Record saved successfully");    
        }
        else{
            return redirect()->back()->with("error","Anonymous error occurred,Please try again");
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*select c.city_name,st.state_name,cr.course,s.* from students s INNER JOIN users u on u.id=s.user_id INNER JOIN cities c on c.id=s.city_id INNER JOIN states st on st.id=s.state_id INNER JOIN courses cr on cr.id= s.course_id WHERE s.user_id=19*/

        $student_data=DB::table('students as s')
                        ->join('users as u','u.id','=','s.user_id')
                        ->join('courses as c','c.id','=','s.course_id')
                        ->join('states as st','st.id','=','s.state_id')
                        ->join('cities as ct','ct.id','=','s.city_id')
                        ->where('s.user_id','=',$id)
                        ->select('u.id','u.name','u.email','u.image_title','u.dob','ct.city_name','st.state_name','c.course','s.address','s.city_id','s.state_id','s.contact','s.course_id','s.registration_date','s.session','s.pin','s.father_name','s.mother_name')
                        ->get();

        
        /*echo "<pre>";
        print_r($student_data[0]);
        echo "<br>";
        exit;*/
        if($student_data->count()){
            return view('admin.updateStudent')->with('data',$student_data[0]);

        }
        else{
            $user_data=User::find($id);
            print_r($user_data->name);
            echo "<br>hi";
        }
        exit;


        /*$student_data=User::find($id);
        return view('admin.updateStudent')->with('data',$student_data);*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $student_data=$request->validate([
            'id'=>'required',
            'name'=>'required',
            'email'=>'required|email',
            'date'=>'required|date'
            ]);

        $student=User::find($request->id);
        $student->name=$request->name;
        $student->email=$request->email;
        $student->dob=$request->date;
        if($student->save()){
            return redirect()->route('smsStudent')->with("update_success","Record updated successfully");
        }
        else{
            return redirect()->back()->with("update_failure","Record not updated, Please try again");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}

