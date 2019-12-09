<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Quality;
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
        $userabonnement = DB::table('usersabonnements')->join('abonnements', 'usersabonnements.abonnement_id', '=', 'abonnements.id')->where('usersabonnements.user_id', '=', Auth::user()->id)->get();
        $privateschedule = DB::table('privateschedule')->join('trainings', 'privateschedule.training_id', '=', 'trainings.id')->join('trainers', 'privateschedule.trainer_id', '=', 'trainers.id')->where('user_id', '=', Auth::user()->id)->where('checked', '=', 1)->select('trainings.name as training_name', 'trainers.name as trainer_name', 'privateschedule.date as privateschedule_date', 'privateschedule.endtrain as privateschedule_endtrain', 'privateschedule.id as privateschedule_id')->get();
        $trainergym2 = DB::table('traintrain')->join('trainers', 'traintrain.trainer_id', '=', 'trainers.id')->join('trainings', 'traintrain.training_id', '=', 'trainings.id')->where('training_id', '=', '1')->orwhere('training_id', '=', '2')->select('trainers.id as id', 'trainers.name as trainer_name', 'start', 'image', 'trainings.name as training_name')->get();
        $abonnement = DB::table('abonnements')->get();

        $quality=Quality::where('user_id','=',Auth::user()->id)->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), '=', date('Y-m', strtotime("now")))->exists();
   
        return view('home', compact('userabonnement','quality', 'abonnement', 'users', 'trainergym2', 'privateschedule'));
    }
    public function quality(Request $request)
    {
        $request->validate([
            'user_id'=> 'required',
            'place'=> 'required',
             'organization'=> 'required',
             'cost'=> 'required',
             'assortment'=> 'required',
             'hygiene'=> 'required',
             'material'=> 'required',
             'quality_lesson'=> 'required',

        ]);

        Quality::create($request->only(['user_id','place', 'organization','cost','assortment','hygiene','material','quality_lesson']));
        return redirect()->route('home');
    }
}
