<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
use App\Mark;
class ExamController extends Controller
{
    public function getExam(){
        $exam=Exam::all();
        return response()->json($exam);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exam=Exam::all();
        // echo "<pre>";
        // print_r($exam);
        // exit;
        return view('admin.exams')->with('exams',$exam);
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
            'exam'=>'required'
            ]);
        $exam=Exam::where('exam_type','=',$request->exam)->get();
        if($exam->count()){
            return redirect()->back()->with('error','your entered exam already exist');
        }else{
            $exam=new Exam;
            $exam->exam_type=$request->exam;
            if($exam->save()){
                return redirect()->back()->with('success','exam added successfully');    
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // print_r($id);
        $exam_data=Exam::find($id);
        return view('admin.updateExam')->with('data',$exam_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=$request->validate([
            'id'=>'required',
            'exam_type'=>'required'
            ]);

        $exam=Exam::where('exam_type','=',$request->exam_type)->get();
        if($exam->count()){
            return redirect()->back()->with('update_failure','previous and updated data should not be same');
            
        }else{
            $exam=Exam::find($request->id);
            $exam->exam_type=$request->exam_type;
            if($exam->save()){
                return redirect()->route('exams')->with('success','exam updated successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        $marks=Mark::where('exam_id','=',$id)->get();
        if($marks->count()){
            return response()->json(404);
        }else{
            $exam=Exam::find($id)->delete();
            return response()->json(200);
        }
    }
}
