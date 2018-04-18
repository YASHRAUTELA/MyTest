<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\Student;
use App\Faculty;
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
			if($faculty->count()){
				$faculty->delete();
				$user->delete();
				return response()->json('faculty deleted successfully');	
			}
			else{
				$user->delete();
				return response()->json('faculty deleted successfully');
			}
			

		}else{
			$student=Student::where('user_id','=',$request->id)->get();
			if($student->count()){
				$student->delete();
				$user->delete();
				return response()->json('student data deleted successfully');
			}
			else{
				$user->delete();
				return response()->json('student data deleted successfully');
			}
		}
	}

	/*
	*Performing update operation on user data
	*/
	public function updateAdmin(Request $request){
		$admin_data=$request->validate([
			'id'=>'required',
			'name'=>'required',
			'email'=>'required|email',
			'date'=>'required|date'
			]);

		$admin=User::find($request->id);
		$admin->name=$request->name;
		$admin->email=$request->email;
		$admin->dob=$request->date;
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

