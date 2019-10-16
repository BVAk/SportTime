<?php

namespace App\Http\Controllers;

use App\Trainer;
use App\Training;
use App\User;
use App\Group;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Facades\Charts;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Admin;
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
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
        $chart = Charts::database($users, 'bar', 'highcharts')
            ->title("Monthly new Register Users")
            ->elementLabel("Total Users")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->groupByMonth(date('Y'), true);
        return view('admin.welcomeadmin', compact('chart'));

    }

    /**
     * Get the list of the clients
     *
     * @rapam Request $request
     * @return \Illuminate\Http\Response
     */
    public function showClients(Request $request)
    {
        // better to user pagination => instated of $users = User::all();
        $users = User::where('name', 'like', "%$request->search%")->orWhere('email', 'like', "%$request->search%")->orWhere('phone', 'like', "%$request->search%")->paginate(10);
        return view('admin.components.clients', compact('users'));
    }

    public function showTrainers(Request $request)
    {
        $trainers = Trainer::with('trainings')->get();
        return view('admin.components.trainers', compact('trainers'));
    }

    public function addTrainers()
    {
        $training = Training::all();
        return view('admin.components.traineradd', compact('training'));
    }

    public function inserttrainer(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|unique:trainers',
            'start' => 'required',
            'birth' => 'required'
        ]);

        if ($request->hasFile('photo')) $image = $this->uploadImage($request, 'photo', 'images/trainers/');
        $request['image'] = isset($image) ? $image : null;
        $trainer = Trainer::create($request->only(['name', 'birth', 'start', 'phone', 'image']));

        $trainer->trainings()->sync($request->trainings);

        return redirect('/admin/trainers');


    }

    /**
     * Validate and store image.
     *
     * @param Request $request
     * @param string $filename
     * @param string $path
     *
     * @return string
     * */
    private function uploadImage(Request $request, $filename, $path)
    {
        $request->validate([
            $filename => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        return $request->file($filename)->store(
            $path, 'public'
        );
    }

    public function schedulegroup()
    {
        $training = Training::where('type','!=','дитячі')->where('type','!=','')->get();
        $groupschedule = DB::table('groupshedule')->join('trainings','groupshedule.train_id','=','trainings.id')->where('type','!=','дитячі')->where('type','!=','')->get();
        return view('admin.components.schedulegroup',compact('training'))->with('groupschedule',$groupschedule);

    }

    public function schedulegroupupdate(Request $request){
       
        $id=$request['Event'][0];
        $start=$request['Event'][1];
        $end=$request['Event'][2];
        
        Training::where('id','=',$id)->update('start'->$start,'end'->$end);        
          
        
        }
    }



