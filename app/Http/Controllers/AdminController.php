<?php

namespace App\Http\Controllers;

use App\Trainer;
use App\Training;
use App\User;
use App\PrivateTraining;
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
            ->title("Поповнення новими клієнтами")
            ->elementLabel("Total Users")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->groupByMonth(date('Y'), true);
        return view('admin.components.statistic', compact('chart'));
    }
    public function welcome()
    {
        $trainergym2 = DB::table('traintrain')->join('trainers', 'traintrain.trainer_id', '=', 'trainers.id')->join('trainings', 'traintrain.training_id', '=', 'trainings.id')->where('training_id', '=', '1')->orwhere('training_id', '=', '2')->select('trainers.id as id', 'trainers.name as trainer_name', 'start', 'image', 'trainings.name as training_name')->get();
        $check=DB::table('privateschedule')->join('trainings', 'privateschedule.training_id', '=', 'trainings.id')->join('trainers', 'privateschedule.trainer_id', '=', 'trainers.id')->join('users', 'privateschedule.user_id', '=', 'users.id')->where('checked', '!=', '1')->where('date', '>=', new \DateTime('now'))->select('users.name as user_name','users.phone as user_phone','trainings.name as training_name', 'trainers.name as trainer_name', 'privateschedule.date as privateschedule_date', 'privateschedule.endtrain as privateschedule_endtrain', 'privateschedule.id as privateschedule_id')->get();
        return view('admin.welcomeadmin', compact('check','trainergym2'));
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
            $path,
            'public'
        );
    }


    public function addClients()
    {
        $users = User::all();
        return view('admin.components.clientadd', compact('users'));
    }
    public function inserteditclient(Request $request, User $id)
    {
   
        User::where('id','=',$id->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'card'=>$request->card
        ]);

        return redirect()->route('admin.clientprofile',$id);
    }  
    public function insertclient(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'card' => 'required',
            'created_at' => 'required',

        ]);

        $trainer = User::create($request->only(['name', 'email', 'phone', 'card', 'created_at']));
$id=User::where('phone','=',$request->phone)->select('id')->first();
        return redirect()->route('admin.clientprofile',$id);
    }


    public function schedulegroup()
    {
        $training = Training::where('type', '!=', 'дитячі')->where('type', '!=', '')->get();
        $groupschedule = DB::table('groupshedule')->join('trainings', 'groupshedule.train_id', '=', 'trainings.id')->where('type', '!=', 'дитячі')->where('type', '!=', '')->get();
        return view('admin.components.schedulegroup', compact('training'))->with('groupschedule', $groupschedule);
    }

    public function scheduleprivate()
    {
        $training = Training::where('type', '!=', '')->get();
        $private=DB::table('privateschedule')->join('trainings', 'privateschedule.training_id', '=', 'trainings.id')->join('trainers', 'privateschedule.trainer_id', '=', 'trainers.id')->join('users', 'privateschedule.user_id', '=', 'users.id')->where('checked', '=', '1')->where('date', '>=', new \DateTime('now'))->select('users.name as user_name','users.phone as user_phone','trainings.name as training_name', 'trainers.name as trainer_name', 'privateschedule.date as privateschedule_date', 'privateschedule.endtrain as privateschedule_endtrain', 'privateschedule.id as privateschedule_id')->get();
        return view('admin.components.scheduleprivate', compact('training','private'));
    }


    public function schedulegroupupdate(Request $request)
    {
        $id = $request['Event'][0];
        $start = $request['Event'][1];
        $end = $request['Event'][2];
        Training::where('id', '=', $id)->update('start'->$start, 'end'->$end);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $id
     * @return \Illuminate\Http\Response
     */
    public function profileClients(User $id)
    {
        $users = User::where('id', '=', $id->id)->get();
        $userabonnement = DB::table('usersabonnements')->where('usersabonnements.user_id', '=', $id->id)->join('abonnements','abonnements.id','=','usersabonnements.abonnement_id')->where('usersabonnements.end','>=', new \DateTime('now'))->orwhere('usersabonnements.amount','>',0)->get();
        $privateschedule = DB::table('privateschedule')->join('trainings', 'privateschedule.training_id', '=', 'trainings.id')->join('trainers', 'privateschedule.trainer_id', '=', 'trainers.id')->where('user_id', '=', $id->id)->where('date', '>=', new \DateTime('now'))->select('trainings.name as training_name', 'trainers.name as trainer_name', 'privateschedule.date as privateschedule_date', 'privateschedule.endtrain as privateschedule_endtrain', 'privateschedule.id as privateschedule_id')->get();
        $trainergym2 = DB::table('traintrain')->join('trainers', 'traintrain.trainer_id', '=', 'trainers.id')->join('trainings', 'traintrain.training_id', '=', 'trainings.id')->where('training_id', '=', '1')->orwhere('training_id', '=', '2')->select('trainers.id as id', 'trainers.name as trainer_name', 'start', 'image', 'trainings.name as training_name')->get();
        $abonnement = DB::table('abonnements')->get();
        
        return view('admin.components.clientprofile', compact('userabonnement', 'abonnement', 'users', 'trainergym2', 'privateschedule'));
    }

    public function editprofile(User $id)
    {
        $users = User::where('id', '=', $id->id)->get();
         
        return view('admin.components.clientedit', compact('users','id'));
    }

    public function statistic()
    {
        return view('admin.components.statistic');
    }
    public function userabonnement(Request $request)
    {
        $abonnement = $request['abonnement'];
        $user = $request['user'];
        $date = new \DateTime('now');
        $date1 = strtotime("now");
        if (DB::table('usersabonnements')->where('user_id', '=', $user)->where('abonnement_id', '=', $abonnement)->where('end', '>=', $date)->exists()) {
            $userabomalready = DB::table('usersabonnements')->where('user_id', '=', $user)->where('abonnement_id', '=', $abonnement)->where('end', '>=', $date)->first();
            $date1 = $userabomalready->end;
            $date1=strtotime($date1);
        }
        if ($abonnement == '1') {
            $end = date('Y-m-d H:i:s', strtotime('+3 month',$date1));
            $amount = NULL;
        } else if ($abonnement == '2') {
            $end = date('Y-m-d H:i:s', strtotime('+1 month',$date1));
            $amount = NULL;
        } else if ($abonnement == '3') {
            $end = NULL;
            $amount = 1;
        } else if ($abonnement == '4') {
            $end = date('Y-m-d H:i:s', strtotime('+3 month',$date1));
            $amount = NULL;
        } else if ($abonnement == '5') {
            $end = date('Y-m-d H:i:s', strtotime('+1 month',$date1));
            $amount = NULL;
        } else if ($abonnement == '6') {
            $end = date('Y-m-d H:i:s', strtotime('+3 month',$date1));
            $amount = NULL;
        } else if ($abonnement == '7') {
            $end = date('Y-m-d H:i:s', strtotime('+1 month',$date1));
            $amount = NULL;
        } else if ($abonnement == '8') {
            $end = NULL;
            $amount = 1;
        } else if ($abonnement == '9') {
            $end = NULL;
            $amount = 1;
        } else if ($abonnement == '10') {
            $end = date('Y-m-d H:i:s', strtotime('+1 month',$date1));
            $amount = NULL;
        } else if ($abonnement == '11') {
            $end = NULL;
            $amount = 1;
        } else if ($abonnement == '12') {
            $end = NULL;
            $amount = 6;
        } else if ($abonnement == '13') {
            $end = NULL;
            $amount = 12;
        } else if ($abonnement == '14') {
            $end = NULL;
            $amount = 1;
        } else if ($abonnement == '15') {
            $end = NULL;
            $amount = 1;
        } else if ($abonnement == '16') {
            $end = NULL;
            $amount = 6;
        } else if ($abonnement == '17') {
            $end = NULL;
            $amount = 1;
        }
        DB::table('usersabonnements')->insert(['user_id' => $user, 'abonnement_id' => $abonnement, 'date' => $date, 'end' => $end, 'amount' => $amount]);


        return back();
    }

    public function privatechange(Request $request, PrivateTraining $id)
    {
        PrivateTraining::where('id', '=', $id->id)->update(['date'=>$request->date,'endtrain'=>date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($request->date))),'checked'=>1]);
        return back();
    }
}
