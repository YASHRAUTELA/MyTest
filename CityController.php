<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use Illuminate\Http\Request;
use DB;

class CityController extends Controller
{
    public function getCityData(Request $request){
        /*$city=City::find($request->state_id)->get();*/
        $city=State::find($request->state_id)->cities;

        return response()->json($city);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$city_data=City::all();
        $city_data=DB::table('cities')
            ->join('states','states.id','=','cities.state_id')
            ->select('cities.*','states.state_name')
            ->get();
        return view('crud.city')->with('city_data',$city_data);
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
        $city_data=new City;
        $city_data->city_name=$request->city;
        $city_data->state_id=$request->state;
        $city_data->save();
        if($city_data){
            $updated_city=DB::table('cities')
                        ->join('states','states.id','=','cities.state_id')
                        ->select('cities.*','states.state_name')
                        ->orderBy('cities.id', 'desc')
                        ->first();
             return response()->json($updated_city);          
        }else{
            return response()->json($city_data);    
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $city_data=City::find($request->id);
        $city_data->city_name=$request->city;
        $city_data->state_id=$request->state;
        $city_data->save();

        $updated_city=DB::table('cities')
                        ->join('states','states.id','=','cities.state_id')
                        ->select('cities.*','states.state_name')
                        ->where('cities.id','=',$request->id)
                        ->get();

        return response()->json($updated_city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        City::find($request->id)->delete();
        return response()->json("deletion successful");
    }
}
