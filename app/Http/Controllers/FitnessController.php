<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class FitnessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function fitnessabout()
    {
$trainings = DB::table('trainings')->where('type','!=','дитячі')->get();
$trainingschild = DB::table('trainings')->where('type','=','дитячі')->get();
$groupschedule = DB::table('groupshedule')->join('trainings','groupshedule.train_id','=','trainings.id')->where('type','!=','дитячі')->where('type','!=','')->get();
$childschedule = DB::table('groupshedule')->join('trainings','groupshedule.train_id','=','trainings.id')->where('type','=','дитячі')->get();
       
return view('fitnessabout', compact('trainings'),['groupschedule'=>$groupschedule,'childschedule' => $childschedule,'trainingschild'=>$trainingschild]);

}
}
?>