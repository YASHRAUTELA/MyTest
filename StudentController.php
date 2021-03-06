<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use DateTime;
use App\Course;
use App\User;
use DB;
use App\Exam;
use Auth;

class StudentController extends Controller
{
    public function getSemesterData(Request $request){
        $users=User::find(Auth::user()->id);

        $student=$users->student;

        $course=$student->course;

        // $course_name=$course->course;

        $semester=$course->semesters;

        return response()->json($semester);
    }

    public function myMarks(){
        return view('student.myMarks');
    }

    public function noMarks(){
        return view('student.marksNotAvailable');
    }


    public function getStudentCourse(Request $request){
        

        $course_data=DB::table('courses')
                    ->join('students','students.course_id','=','courses.id')
                    ->where('students.id','=',$request->student_id)
                    ->select('courses.id','courses.course','students.id as student_id')
                    ->get();
       
        return response()->json($course_data[0]);
       
    }

    /*
    *Rendering all the students for entering the marks
    */
    public function getStudentForMarks(){
        /*$student_data=User::where('role_id','=',3)->get();*/
        
        $student_data=DB::table('students')
                    ->join('users','users.id','=','students.user_id')
                    ->where('users.role_id','=',3)
                    ->select('students.id','users.name','users.id as user_id')
                    ->get();
        return response()->json($student_data);
    }

    /*
    *Rendering all student data to the admin Panel
    */
    public function getStudent(){
        
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

        $student_data=DB::table('students as s')
                        ->join('users as u','u.id','=','s.user_id')
                        ->join('courses as c','c.id','=','s.course_id')
                        ->join('states as st','st.id','=','s.state_id')
                        ->join('cities as ct','ct.id','=','s.city_id')
                        ->where('s.user_id','=',$id)
                        ->select('u.id','u.name','u.email','u.image_title','u.dob','ct.city_name','st.state_name','c.course','s.address','s.city_id','s.state_id','s.contact','s.course_id','s.registration_date','s.session','s.pin','s.father_name','s.mother_name')
                        ->get();

        
        /*echo "<pre>";
        print_r($student_data[0]->id);
        echo "<br>";
        print_r($student_data);
        exit;*/
        if($student_data->count()){
            return view('admin.updateStudent')->with('data',$student_data[0]);

        }
        else{
            /*$pages_array[] = (object) array('slug' => 'xxx', 'title' => 'etc')*/


            $user_data=User::find($id);
            /*echo "<pre>";
            print_r($user_data->id);
            exit;*/
            if($user_data->exists()){
                $user_data_temp[]=(object) array('id'=>$user_data->id,'name'=>$user_data->name,'email'=>$user_data->email,'image_title'=>$user_data->image_title,'dob'=>$user_data->dob,'city_name'=>'','state_name'=>'','course'=>'','address'=>'','city_id'=>'','state_id'=>'','contact'=>'','course_id'=>'','registration_date'=>'','session'=>'','pin'=>'','father_name'=>'','mother_name'=>'');
                /*echo "<pre>";
                print_r($user_data_temp);
                echo "<br>";
                print_r($user_data_temp[0]->name);
                echo "<br>";
                exit;*/
                return view('admin.updateStudent')->with('data',$user_data_temp[0]);
            }else{
                return redirect()->back();
            }
            
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
            'name'=>'required|max:50',
            'email'=>'required|email',
            'dob'=>'required|date',
            'father_name'=>'required|min:3',
            'mother_name'=>'required|min:3',
            'state'=>'required',
            'city'=>'required',
            'contact'=>'required|max:10',
            'course'=>'required',
            'registration_date'=>'required|date',
            'pin'=>'required',
            'address'=>'required'
            ]);
        



        $course=Course::where('id','=',$request->course)->get();
        $duration=$course[0]->duration;
        $date = DateTime::createFromFormat("Y-m-d", $request->registration_date);
        $year=$date->format("Y");
        $lastyear=$year+$duration;
        $session=$year."-".$lastyear;
        
       $check_student=Student::where('address','=',$request->address)
                                ->where('city_id','=',$request->city)
                                ->where('state_id','=',$request->state)
                                ->where('contact','=',$request->contact)
                                ->where('course_id','=',$request->course)
                                ->where('registration_date','=',$request->registration_date)
                                ->where('session','=',$session)
                                ->where('pin','=',$request->pin)
                                ->where('father_name','=',$request->father_name)
                                ->where('mother_name','=',$request->mother_name)
                                ->get();
        /*print_r($check_student->count());
        exit;*/
        if($check_student->count()){
            return redirect()->route('smsStudent')->with("update_error","Same record cannot be updated");
        }

        $user_data=User::find($request->id);
        $user_data->id=$request->id;
        $user_data->name=$request->name;
        $user_data->email=$request->email;
        $user_data->dob=$request->dob;

        if($user_data->save()){
            $student_data=Student::where('user_id','=',$request->id)->get();
            if($student_data->count()){

                /*It will update student data if student already exists*/

                $student_data=Student::where('user_id','=',$request->id)
                                    ->update([
                                        'father_name'=>$request->father_name,
                                        'mother_name'=>$request->mother_name,
                                        'state_id'=>$request->state,
                                        'city_id'=>$request->city,
                                        'contact'=>$request->contact,
                                        'course_id'=>$request->course,
                                        'registration_date'=>$request->registration_date,
                                        'pin'=>$request->pin,
                                        'address'=>$request->address,
                                        'session'=>$session
                                        ]);
                return redirect()->route('smsStudent')->with("update_success","Record updated successfully");
            }
            else{
                /*It will create a new student and executes in a case when user exists but student does not*/

                $student_data=new Student;
                $student_data->user_id=$request->id;
                $student_data->address=$request->address;
                $student_data->city_id=$request->city;
                $student_data->state_id=$request->state;
                $student_data->contact=$request->contact;
                $student_data->course_id=$request->course;
                $student_data->registration_date=$request->registration_date;
                $student_data->session=$session;
                $student_data->pin=$request->pin;
                $student_data->father_name=$request->father_name;
                $student_data->mother_name=$request->mother_name;
                
                if($student_data->save()){
                    return redirect()->route('smsStudent')->with("update_success","Record updated successfully");
                }
                else{
                    return redirect()->back()->with("update_failure","Record not updated, Please try again");
                }
            }
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
