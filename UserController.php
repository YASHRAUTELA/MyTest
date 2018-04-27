<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\Student;
use App\Faculty;
use App\Mail;
use App\VerifyUser;
use App\Mark;
class UserController extends Controller
{

	public function deleteUserInfo(Request $request){
		$user=User::find($request->id);

		if($user->role_id==1){
			$user->delete();
			return response()->json('admin data deleted successfully');
		}
		elseif($user->role_id==2){

			$faculty=Faculty::where('user_id','=',$request->id)->get();

			$verify_user=VerifyUser::where('user_id','=',$request->id)
						->get();

			$faculty_mail=Mail::where('to_email','=',$user->email)
								->orWhere('from_email','=',$user->email)
								->get();

			if($faculty->count()){
				$faculty[0]->delete();
			}

			if($verify_user->count()){
				$verify_user=VerifyUser::where('user_id','=',$request->id)
						->delete();
			}

			if($faculty_mail->count()){
					$faculty_mail=Mail::where('to_email','=',$user->email)
								->orWhere('from_email','=',$user->email)
								->delete();
			}
			$user->delete();

			return response()->json('faculty and its all associated data deleted successfully');
		}
		else{
			// $user=User::find($request->id);

			// $student=$user->student;
			$student=Student::where('user_id','=',$request->id)->get();
			//return response()->json($student->count());

			if($student->count()){
				$marks=Mark::where('student_id','=',$student[0]->id)->get();	
			}
			

			

			$verify_user=VerifyUser::where('user_id','=',$request->id)
						->get();


			$student_mail=Mail::where('to_email','=',$user->email)
								->orWhere('from_email','=',$user->email)
								->get();
			//return response()->json(sizeof($student));
			

			if($student->count()){
				
				if($marks->count()){
					// return response()->json($marks[0]);
					$marks[0]->delete();
				}
				$student[0]->delete();
			}

			if($verify_user->count()){
				$verify_user=VerifyUser::where('user_id','=',$request->id)
						->delete();
			}

			if($student_mail->count()){
				$student_mail=Mail::where('to_email','=',$user->email)
							->orWhere('from_email','=',$user->email)
							->delete();
			}
			$user->delete();
			return response()->json('student and its all associated data deleted successfully');

			/*$student=Student::where('user_id','=',$request->id)->get();
			
			$verify_user=VerifyUser::where('user_id','=',$request->id)
						->delete();

			
			$student_mail=Mail::where('to_email','=',$user->email)
								->orWhere('from_email','=',$user->email)
								->delete();
			
			

			if($student->count()){
				$student->delete();
				$user->delete();
				return response()->json('student data deleted successfully');
			}
			else{
				$user->delete();
				return response()->json('student data deleted successfully');
			}*/
		}
	}

	/*
	*Performing update operation on user data
	*/
	public function updateAdmin(Request $request){
		$admin_data=$request->validate([
			'id'=>'required',
			'name'=>'required|min:3',
			'email'=>'required|email',
			'dob'=>'required|date'
			]);

		$admin=User::find($request->id);
		$admin->name=$request->name;
		$admin->email=$request->email;
		$admin->dob=$request->dob;
		if($admin->save()){
			return redirect()->route('smsAdmin')->with("update_success","Record updated successfully");
		}
		else{
			return redirect()->back()->with("update_failure","Record not updated, Please try again");
		}
	}

	/*
	*Showing the edit page for selected admin
	*/
	public function editAdmin($id){
		$admin_data=User::find($id);
		return view('admin.updateAdmin')->with('data',$admin_data);
	}

	/*
	*Rendering particular user Info on modal
	*/
	public function getUserInfo(Request $request){
		$user_data=User::find($request->id);
		return response()->json($user_data);
	}

	/*
	*Getting those users details who are students
	*/
    public function getUser(){

    	$user=DB::table('users')
		    ->whereNotIn('id', function($query)
		    {
		        $query->select(DB::raw('user_id'))
		              ->from('students')
		              ->whereRaw('students.user_id = users.id');
		    })
		    ->get();

    	return response()->json($user);
    }

    /*
    *Getting and Rendering admin details
    */
    public function getAdmin(){
    	
    	 $admin_data= User::where('role_id','=',1)->get();
    	 
        if($admin_data->count()){
            return view('admin.admins')->with('data',$admin_data);    
        }
        else{
            return view('admin.noAdmin');
        }
    }
}
