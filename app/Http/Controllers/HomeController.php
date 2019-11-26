<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $users = User::where('id', '=',  Auth::user()->id)->get();
        $userabonnement = DB::table('usersabonnements')->where('usersabonnements.user_id', '=', Auth::user()->id)->join('abonnements', 'abonnements.id', '=', 'usersabonnements.abonnement_id')->where('usersabonnements.end', '>=', new \DateTime('now'))->orwhere('usersabonnements.amount', '>', 0)->get();
        $privateschedule = DB::table('privateschedule')->join('trainings', 'privateschedule.training_id', '=', 'trainings.id')->join('trainers', 'privateschedule.trainer_id', '=', 'trainers.id')->where('user_id', '=', Auth::user()->id)->where('checked','=',1)->where('date', '>=', new \DateTime('now'))->select('trainings.name as training_name', 'trainers.name as trainer_name', 'privateschedule.date as privateschedule_date', 'privateschedule.endtrain as privateschedule_endtrain', 'privateschedule.id as privateschedule_id')->get();
        $trainergym2 = DB::table('traintrain')->join('trainers', 'traintrain.trainer_id', '=', 'trainers.id')->join('trainings', 'traintrain.training_id', '=', 'trainings.id')->where('training_id', '=', '1')->orwhere('training_id', '=', '2')->select('trainers.id as id', 'trainers.name as trainer_name', 'start', 'image', 'trainings.name as training_name')->get();
        $abonnement = DB::table('abonnements')->get();

        
   
        return view('home', compact('userabonnement', 'abonnement', 'users', 'trainergym2', 'privateschedule'));
    }
}
