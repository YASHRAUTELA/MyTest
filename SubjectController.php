<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use DB;

class SubjectController extends Controller
{
    /*
    *rendering all the subjects for the selected course
    */
    public function getSubject(Request $request){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$subject=Subject::all();*/

        $subject=DB::table('subjects')
                ->join('semesters','semesters.id','=','subjects.semester_id')
                ->join('courses','courses.id','=','subjects.course_id')
                ->select('subjects.*','semesters.semester','courses.course')
                ->get();
        /*echo "<pre>";        
        print_r($subject);
        exit;*/

        return view('admin.subjects')->with('subject',$subject);
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
            'course'=>'required',
            'semester'=>'required',
            'subject'=>'required|unique:subjects,subject'
            ]);

        // print_r($request->course);
        // echo "<br>";
        // print_r($request->subject);
        // echo "<br>";
        // print_r($request->semester);
        // exit;
        $subject=new Subject;
        $subject->subject=$request->subject;
        $subject->course_id=$request->course;
        $subject->semester_id=$request->semester;
        if($subject->save()){
            return redirect()->back()->with('success','subject added successfully');    
        }
        else{
            return redirect()->back()->with('failure','some error occurred, Please try again');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $subject=Subject::find($id);
        /*echo "<pre>";
        print_r($subject);
        exit;*/
        $subject=DB::table('subjects')
                ->join('semesters','semesters.id','=','subjects.semester_id')
                ->select('subjects.*','semesters.semester')
                ->where('subjects.id','=',$id)
                ->get();
        return view('admin.updateSubject')->with('data',$subject[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=$request->validate([
            'id'=>'required',
            'subject'=>'required|string|max:50',
            'course'=>'required',
            'semester'=>'required'
            ]);

        $subject =Subject::find($request->id);
        $subject->subject=$request->subject;
        $subject->course_id=$request->course;
        $subject->semester_id=$request->semester;
        if($subject->save()){
            return redirect()->route('subject')->with('success','data updated successfully' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        $subject_data=Subject::find($request->id);
        if($subject_data->delete()){
            return response()->json(200);
        }
        else{
            return response()->json(404);
        }
    }
}

