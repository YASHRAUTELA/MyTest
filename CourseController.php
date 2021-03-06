<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use DB;
use App\Mark;
use App\User;
class CourseController extends Controller
{

    public function getUsedCourse(){
        $result=DB::table('courses')
                ->whereIn('id',function ($query) {
                                $query->select(DB::raw('course_id'))
                                  ->from('semesters')
                                  ->whereRaw('semesters.course_id = courses.id');
                            })
                ->get();
        return response()->json($result);
    }

    public function getNotUsedCourse(){
        $result=DB::table('courses')
                ->whereNotIn('id',function ($query) {
                                $query->select(DB::raw('course_id'))
                                  ->from('semesters')
                                  ->whereRaw('semesters.course_id = courses.id');
                            })
                ->get();
        return response()->json($result);
    }

    public function getCourse(){
        $course_data=Course::all();
        return response()->json($course_data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_data=Course::all();
        
        return view('crud.course')->with('course_data',$course_data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $course_data=Course::find($request->id);
        $course_data->course=$request->course;
        $course_data->duration=$request->duration;
        $course_data->save();

        return response()->json($course_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //fetch course
        $course=Course::find($request->id);

        $marks=$course->marks;

        if($marks->count()){
            return response()->json(404);
        }
        else{
            $semesters=$course->semesters;
            //if semester exists with the selected course
            if($semesters->count()){
                return response()->json(404);
            }
            else{
                //if the students are registered with the selected course
                $students=$course->students;
                if($students->count()){
                    return response()->json(404);
                }
                else{
                    //if the subjects are exists with the selected course
                    $subjects=$course->subjects;
                    if($subjects->count()){
                        return response()->json(404);
                    }
                    else{
                        $course->delete();
                        return response()->json(200);
                    }
                }
            }
        }
    }

    public function addCourse(Request $request){
        $course_data=new Course;
        $course_data->course=$request->course;
        $course_data->duration=$request->duration;
        $course_data->save();

        return response()->json($course_data);
    }
}
