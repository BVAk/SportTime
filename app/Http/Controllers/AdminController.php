<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Admin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
      if($this->middleware('auth:admin')){
        return view('admin.welcomeadmin');}
        else{ return view('admin.loginadmin');}
    }

    public function showClients(){
        $this->middleware('auth:admin');
        $users=DB::table('users')->get(); 
        return view('admin.components.clients')->with ('users', $users);
    }

    public function showTrainers(){
        $this->middleware('auth:admin');
        $trainers=DB::table('trainers')->get();
        $traintrain=DB::table('trainers')->join('traintrain','trainers.id','=','traintrain.trainer_id')->join('trainings','trainings.id','=','traintrain.training_id')->get(); 
        return view('admin.components.trainers')->with ('trainers', $trainers);
    }

   
}

?>