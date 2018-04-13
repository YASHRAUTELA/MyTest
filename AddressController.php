<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\User;
use Validator;
use DB;
class HomeController extends Controller
{
    public function create(Request $request){
 
       $person= DB::table('persons')->insert([
            'name'=>$request->name,
            'street_number'=>$request->street_number,
            'route'=>$request->route,
            'locality'=>$request->locality,
            'state'=>$request->state,
            'postal_code'=>$request->postal_code,
            'country'=>$request->country
        ]);
       return back()->with('success','Record uploaded successfully');
    }
    
}

