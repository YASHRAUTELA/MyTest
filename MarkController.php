<?php

namespace App\Http\Controllers;

use App\Mark;
use Illuminate\Http\Request;
use DB;
class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $marks=DB::table('marks')
            ->join('students','students.id','=','marks.student_id')
            ->join('courses','courses.id','=','marks.course_id')
            ->join('semesters','semesters.id','=','marks.semester_id')
            ->join('subjects','subjects.id','=','marks.subject_id')
            ->join('exams','exams.id','=','marks.exam_id')
            ->join('users','users.id','=','students.user_id')
            ->select('marks.*','users.name','courses.course','semesters.semester','subjects.subject','exams.exam_type')
            ->get();
        // dd($marks);
        return view('admin.marks')->with('marks',$marks);
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
            'student'=>'required',
            'course'=>'required',
            'semester'=>'required',
            'subject'=>'required',
            'exam'=>'required',
            'marks_obtained'=>'required|integer|max:100',
            'total_marks'=>'required|integer|max:100'
            ]);
        
        $marks_data=Mark::where('student_id','=',$request->student)
                        ->where('course_id','=',$request->course)
                        ->where('semester_id','=',$request->semester)
                        ->where('subject_id','=',$request->subject)
                        ->where('exam_id','=',$request->exam)
                        ->get();
        // echo "<pre>";
        // print_r($request->exam);
        // exit;

        if($marks_data->count()){
            return redirect()->route('marks')->with('error','duplicate data entry');
        }else{
            $marks=new Mark;
            $marks->student_id=$request->student;
            $marks->course_id=$request->course;
            $marks->semester_id=$request->semester;
            $marks->subject_id=$request->subject;
            $marks->exam_id=$request->exam;
            $marks->marks_obtained=$request->marks_obtained;
            $marks->total_marks=$request->total_marks;
            if($marks->save()){
                return redirect()->route('marks')->with('success','data inserted successfully');
            }else{
                return redirect()->route('marks')->with('error','some error occurred, please try again');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $marks=Mark::find($id);
        $marks=DB::table('marks')
            ->join('students','students.id','=','marks.student_id')
            ->join('courses','courses.id','=','marks.course_id')
            ->join('semesters','semesters.id','=','marks.semester_id')
            ->join('subjects','subjects.id','=','marks.subject_id')
            ->join('users','users.id','=','students.user_id')
            ->select('marks.*','users.name','courses.course','semesters.semester','subjects.subject')
            ->where('marks.id','=',$id)
            ->get();
        /*echo "<pre>";
        print_r($marks[0]);
        exit;*/
        return view('admin.updateMarks')->with('data',$marks[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=$request->validate([
            'student_id'=>'required',
            'course_id'=>'required',
            'semester_id'=>'required',
            'subject_id'=>'required',
            'marks_obtained'=>'required',
            'total_marks'=>'required',
            ]);
        
        $mark=Mark::find($request->id);
        if(($mark->marks_obtained==$request->marks_obtained)AND($mark->total_marks==$request->total_marks)){
            return redirect()->route('marks')->with('success','noting to update');

        }
        else{
            $mark->marks_obtained=$request->marks_obtained;
            $mark->total_marks=$request->total_marks;
            if($mark->save()){
                return redirect()->route('marks')->with('success','marks updated successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $mark=Mark::find($request->id)->delete();
        return response()->json(200);

    }
}

