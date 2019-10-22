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
$trainings = DB::table('trainings')->get();
$groupschedule = DB::table('groupshedule')->join('trainings','groupshedule.train_id','=','trainings.id')->where('type','!=','дитячі')->where('type','!=','')->get();
       
return view('fitnessabout', compact('trainings'))->with('groupschedule',$groupschedule);

}
}
?>