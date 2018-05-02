<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
use App\Mark;
use Validator;
class ExamController extends Controller
{

    public function editExam(Request $request){
        $validator=Validator::make($request->all(),[
                'exam_type'=>'required'
            ]);

        if($validator->passes()){
            // return response()->json($request->exam_type);
            $exam=Exam::find($request->id);
            $exam->exam_type=$request->exam_type;
            $exam->save();
            return response()->json($exam);
        }
        return response()->json(['error'=>$validator->errors()->all()]);

       
    }
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

        $validator=Validator::make($request->all(),[
                'exam_type'=>'required'
            ]);

        if($validator->passes()){
            $exam=Exam::where('exam_type','=',$request->exam_type)->get();
            
            if($exam->count()){
                return response()->json(404);
            }
            else{
                $exam=new Exam;
                $exam->exam_type=$request->exam_type;
                
                if($exam->save()){
                    return response()->json($exam);
                }
            }
            // return response()->json(['success'=>'Added new records.']);

        }
        return response()->json(['error'=>$validator->errors()->all()]);
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

