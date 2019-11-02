<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
        $trainings = DB::table('trainings')->where('type', '=', '')->get();
        $trainingsgroup = DB::table('trainings')->where('type', '!=', 'дитячі')->where('type', '!=', '')->get();
        $trainingschild = DB::table('trainings')->where('type', '=', 'дитячі')->get();
        $groupschedule = DB::table('groupshedule')->join('trainings', 'groupshedule.train_id', '=', 'trainings.id')->where('type', '!=', 'дитячі')->where('type', '!=', '')->get();
        $childschedule = DB::table('groupshedule')->join('trainings', 'groupshedule.train_id', '=', 'trainings.id')->where('type', '=', 'дитячі')->get();
        $trainergym = DB::table('traintrain')->join('trainers', 'traintrain.trainer_id', '=', 'trainers.id')->where('training_id', '=', '91')->get();
        return view('fitnessabout', compact('trainings'), ['trainergym' => $trainergym, 'groupschedule' => $groupschedule, 'childschedule' => $childschedule, 'trainingschild' => $trainingschild, 'trainingsgroup' => $trainingsgroup]);
    }

    public function trainer()
    {
        $trainergym = DB::table('traintrain')->join('trainers', 'traintrain.trainer_id', '=', 'trainers.id')->join('trainings', 'traintrain.training_id', '=', 'trainings.id')->where('training_id', '=', '91')->orwhere('training_id', '=', '92')->select('trainers.id as id', 'trainers.name as trainer_name', 'start', 'image', 'trainings.name as training_name')->get();
        $trainergym2 = DB::table('traintrain')->join('trainers', 'traintrain.trainer_id', '=', 'trainers.id')->join('trainings', 'traintrain.training_id', '=', 'trainings.id')->where('training_id', '=', '91')->orwhere('training_id', '=', '92')->select('trainers.id as id', 'trainers.name as trainer_name', 'start', 'image', 'trainings.name as training_name')->get();
        return view('trainers', compact('trainergym'), ['trainergym2' => $trainergym2]);
    }
    /**
     * Get the list of the clients
     *
     * @rapam Request $request
     * @return \Illuminate\Http\Response
     */
    public function insertprivate(Request $request)
    {
        $trainer = $request['trainer'];
        $training = DB::table('traintrain')->where('trainer_id', '=', $trainer)->where('training_id', '=', '91')->orwhere('training_id', '=', '92')->first()->training_id;
        $datetrain = $request['datetrain'];
        $endtrain= date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($datetrain)));
        

        $user = $request['user'];
        $usernon = $request['usernon'];
        if (empty($user)) {
            if (User::where('phone', '=', $usernon)->exists()) {
                $user = User::where('phone', '=', $usernon)->first()->id;
            } else {
                User::insert(['name' => 'unknown ' + $usernon, 'email' => 'un' + $usernon + '@gmail.com', 'phone' => $usernon, 'created_at' => new \DateTime('now')]);
                $user = User::where('phone', '=', $usernon)->first()->id;
            }
        } 
        DB::table('privateschedule')->insert(['trainer_id' => $trainer, 'training_id' => $training, 'user_id' => $user, 'date' => $datetrain,'endtrain'=>$endtrain]);


        return back();
    }
}
