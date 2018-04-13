<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use DateTime;
use App\Course;

class StudentController extends Controller
{
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
            return redirect()->back()->with("success","Record saved successfully");;    
        }
        else{
            return redirect()->back()->with("error","Anonymous error occurred,Please try again");;
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
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
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

