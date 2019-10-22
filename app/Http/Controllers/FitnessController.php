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
return view('fitnessabout', compact('trainings'));

}
}
?>