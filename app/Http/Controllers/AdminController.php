<?php

namespace App\Http\Controllers;

use App\Trainer;
use App\Training;
use App\User;
use App\PrivateTraining;
use App\Visit;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Auth;

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
    public function welcome()
    {
        $trainergym2 = DB::table('traintrain')->join('trainers', 'traintrain.trainer_id', '=', 'trainers.id')->join('trainings', 'traintrain.training_id', '=', 'trainings.id')->where('training_id', '=', '1')->orwhere('training_id', '=', '2')->select('trainers.id as id', 'trainers.name as trainer_name', 'start', 'image', 'trainings.name as training_name')->get();

        if (DB::table('privateschedule')->join('trainings', 'privateschedule.training_id', '=', 'trainings.id')->join('trainers', 'privateschedule.trainer_id', '=', 'trainers.id')->join('users', 'privateschedule.user_id', '=', 'users.id')->where('checked', '!=', '1')->where('date', '>=', new \DateTime('now'))->select('users.name as user_name', 'users.phone as user_phone', 'trainings.name as training_name', 'trainers.name as trainer_name', 'privateschedule.date as privateschedule_date', 'privateschedule.endtrain as privateschedule_endtrain', 'privateschedule.id as privateschedule_id')->exists()) {
            $check = DB::table('privateschedule')->join('trainings', 'privateschedule.training_id', '=', 'trainings.id')->join('trainers', 'privateschedule.trainer_id', '=', 'trainers.id')->join('users', 'privateschedule.user_id', '=', 'users.id')->where('checked', '!=', '1')->where('date', '>=', new \DateTime('now'))->select('users.name as user_name', 'users.phone as user_phone', 'trainings.name as training_name', 'trainers.name as trainer_name', 'privateschedule.date as privateschedule_date', 'privateschedule.endtrain as privateschedule_endtrain', 'trainers.id as trainer_id', 'privateschedule.id as privateschedule_id')->get();
            $checkme = NULL;
        } else {
            $checkme = "Всі персональні тренування підтвердженні";
            $check = [];
        }
        if (Auth::user()->role == 'admin') {
            return view('admin.welcomeadmin', compact('check', 'trainergym2', 'checkme'));
        } else if (Auth::user()->role == 'trainer') {
            $train_id = Trainer::where('name', '=', Auth::user()->name)->first();

            return $this->profileTrainers($train_id);
        }
    }

    /**
     * Get the list of the clients
     *
     * @rapam Request $request
     * @return \Illuminate\Http\Response
     */


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
            'birth' => 'required',
            'email' => 'required',
        ]);

        if ($request->hasFile('photo')) $image = $this->uploadImage($request, 'photo', 'images/trainers/');
        $request['image'] = isset($image) ? $image : null;
        $trainer = Trainer::create(['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'birth' => $request->birth, 'start' => $request->start, 'salary' => '10000', 'image' => $request['image']]);
        DB::table('admins')->insert(['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'password' => bcrypt($request->email), 'role' => 'trainer']);
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

    public function profileTrainers(Trainer $id)
    {
        $trainers = Trainer::where('id', '=', $id->id)->get();
        $privateschedule = DB::table('privateschedule')->join('trainings', 'privateschedule.training_id', '=', 'trainings.id')->where('checked', '=', 1)->join('users', 'privateschedule.user_id', '=', 'users.id')->where('privateschedule.trainer_id', '=', $id->id)->select('trainings.name as training_name', 'users.name as user_name', 'privateschedule.date as privateschedule_date', 'privateschedule.endtrain as privateschedule_endtrain', 'privateschedule.id as privateschedule_id')->get();
       
        $date1 = strtotime("now");
        $end = date('Y-m-d H:i:s', strtotime('-1 month', $date1));
        if(DB::table('privateschedule')->where('privateschedule.trainer_id', '=', $id->id)->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->where('checked', '=', 1)->exists()){
        $privateschedulechart = DB::table('privateschedule')->where('privateschedule.trainer_id', '=', $id->id)->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->where('checked', '=', 1)->count(DB::raw('DISTINCT privateschedule.user_id'));
        $abonnementchart = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->count(DB::raw('DISTINCT user_id'));
        $percentchart = Charts::create('percentage', 'justgage')
            ->title('Відсоток індивідуальних тренувань за останній місяць')
            ->elementLabel('%')
            ->values([$privateschedulechart / $abonnementchart * 100, 0, 100])
            ->responsive(false)
            ->height(300)
            ->width(0);
        }
        $amountrepeat = 0;
        $amountrepeatgroup2 = 0;
        $amountrepeatchild2 = 0;
        $amountrepeatprivate2 = 0;
        $end = date('Y-m-d H:i:s', strtotime('-6 month', $date1));
        $trainertrainings = DB::table('traintrain')->where('trainer_id', '=', $id->id)->get();
        foreach ($trainertrainings as $trainertraining) {
            if ($trainertraining->training_id >= 3 && $trainertraining->training_id <= 14) {
                $amountrepeatgroup = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->whereIn('abonnement_id', [1, 3])->select(DB::raw('count(id) as `count`'))->groupBy('user_id')->get();
                foreach ($amountrepeatgroup as $amountrepeatgroup1) {
                    if ($amountrepeatgroup1->count > 1) {
                        $amountrepeatgroup2 += $amountrepeatgroup1->count;
                    }
                }
            }
            if ($trainertraining->training_id >= 15 && $trainertraining->training_id <= 17) {
                $amountrepeatchild = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->whereIn('abonnement_id', [9, 10])->select(DB::raw('count(id) as `count`'))->groupBy('user_id')->get();
                foreach ($amountrepeatchild as $amountrepeatchild1) {
                    if ($amountrepeatchild1->count > 1) {
                        $amountrepeatchild2 += $amountrepeatchild1->count;
                    }
                }
            }
            if ($trainertraining->training_id == 1 || $trainertraining->training_id == 2) {
                $privatescheduletrainer = DB::table('privateschedule')->where('trainer_id', '=', $id->id)->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->select(DB::raw('DISTINCT user_id as `user_id`'))->get();
                $amountrepeatprivate = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->whereIn('abonnement_id', [11, 17])->select(DB::raw('count(id) as `count`'), DB::raw('user_id as `user_id`'))->groupBy('user_id')->get();
                foreach ($privatescheduletrainer as $privatescheduletrainer1) {
                    foreach ($amountrepeatprivate as $amountrepeatprivate1) {
                        if ($privatescheduletrainer1->user_id == $amountrepeatprivate1->user_id)
                            if ($amountrepeatprivate1->count > 1) {
                                $amountrepeatprivate2 += $amountrepeatprivate1->count;
                            }
                    }
                }
            }
        }
        $amounttype = array();
        $amounttype[] = $amountrepeatgroup2;
        $amounttype[] = $amountrepeatchild2;
        $amounttype[] = $amountrepeatprivate2;

        $percentrepeatabonnementcharttype = Charts::create('pie', 'highcharts')
            ->title('Кількість клієнтів, які здійснюють повторну покупку абонемента в окремому типі тренувань за останні пів року')
            ->labels(['Групові заняття', 'Дитячі заняття', 'Індивідуальні заняття'])
            ->values($amounttype)
            ->responsive(false)
            ->dimensions(1000, 500);



        return view('admin.components.trainerprofile', compact('percentrepeatabonnementcharttype', 'trainers', 'percentchart', 'privateschedule', 'privateschedulechart', 'abonnementchart'));
    }

    public function editprofiletrainers(Trainer $id)
    {
        $users = Trainer::where('id', '=', $id->id)->get();
        $training = DB::table('traintrain')->join('trainings', 'traintrain.training_id', '=', 'trainings.id')->where('traintrain.trainer_id', '=', $id->id)->get();
        $trainings = DB::table('trainings')->get();
        return view('admin.components.traineredit', compact('users', 'id', 'training', 'trainings'));
    }
    public function insertedittrainer(Request $request, Trainer $id)
    {
        Trainer::where('id', '=', $id->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'card' => $request->card,
            'health' => $request->health
        ]);
        return redirect()->route('admin.trainerprofile', $id);
    }


    public function showClients(Request $request)
    {
        // better to user pagination => instated of $users = User::all();
        $users = User::where('name', 'like', "%$request->search%")->orWhere('email', 'like', "%$request->search%")->orWhere('phone', 'like', "%$request->search%")->orWhere('card', 'like', "%$request->search%")->paginate(10);
        return view('admin.components.clients', compact('users'));
    }
    public function addClients()
    {
        $users = User::all();

        return view('admin.components.clientadd', compact('users'));
    }

    public function addvisit(Request $request)
    {
        $usercard = $request['usercard'];
        $userphone = $request['userphone'];
        $user = User::where('card', '=', $usercard)->orwhere('phone', '=', $userphone)->first();
        $message = "Не відмічено!";
        if (DB::table('usersabonnements')->where('usersabonnements.user_id', '=', $user->id)->where('end', '>=', new \DateTime('now'))->orwhere('amount', '>', 0)->exists()) {
            $userabonnement = DB::table('usersabonnements')->where('user_id', '=',  $user->id)->get();
            foreach ($userabonnement as $userabonnement) {

                if (($userabonnement->end) > (new \DateTime('now'))) {
                    DB::table('visiting')->insert(['user_id' => $user->id, 'date' => new \DateTime('now')]);
                    $message =  $user->name . ', успішно відмічено!';
                } else if (($userabonnement->amount) > 0) {
                    DB::table('visiting')->insert(['user_id' => $user->id, 'date' => new \DateTime('now')]);
                    DB::table('usersabonnements')->where('id', '=', $userabonnement->id)->update(['amount' => ($userabonnement->amount - 1)]);
                    $message =  $user->name . ', успішно відмічено!';
                }
            }
        } else {
            $message = 'Не оплачено!';
        }
        return Redirect()->back()->with(['message' => $message]);
    }


    public function inserteditclient(Request $request, User $id)
    {

        User::where('id', '=', $id->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'card' => $request->card,
            'health' => $request->health
        ]);

        return redirect()->route('admin.clientprofile', $id);
    }
    public function insertclient(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'card' => 'required',
            'health' => 'required',
            'created_at' => 'required',

        ]);

        User::create($request->only(['name', 'email', 'phone', 'card', 'created_at', 'health']));
        $id = User::where('phone', '=', $request->phone)->select('id')->first();
        return redirect()->route('admin.clientprofile', $id);
    }


    public function schedulegroup()
    {
        $training = Training::where('type', '!=', 'дитячі')->where('type', '!=', '')->get();
        $groupschedule = DB::table('groupshedule')->join('trainings', 'groupshedule.train_id', '=', 'trainings.id')->where('type', '!=', 'дитячі')->where('type', '!=', '')->get();
        $name = "Групові заняття";
        return view('admin.components.schedulegroup', compact('training', 'name'))->with('groupschedule', $groupschedule);
    }

    public function schedulechild()
    {
        $training = Training::where('type', '=', 'дитячі')->get();
        $name = "Заняття для дітей";
        $groupschedule = DB::table('groupshedule')->join('trainings', 'groupshedule.train_id', '=', 'trainings.id')->where('type', '=', 'дитячі')->get();
        return view('admin.components.schedulegroup', compact('training', 'name'))->with('groupschedule', $groupschedule);
    }
    public function scheduleprivate()
    {
        $training = Training::where('type', '!=', '')->get();
        $private = DB::table('privateschedule')->join('trainings', 'privateschedule.training_id', '=', 'trainings.id')->join('trainers', 'privateschedule.trainer_id', '=', 'trainers.id')->join('users', 'privateschedule.user_id', '=', 'users.id')->where('checked', '=', '1')->where('date', '>=', new \DateTime('now'))->select('users.name as user_name', 'users.phone as user_phone', 'trainings.name as training_name', 'trainers.name as trainer_name', 'privateschedule.date as privateschedule_date', 'privateschedule.endtrain as privateschedule_endtrain', 'privateschedule.id as privateschedule_id')->get();
        return view('admin.components.scheduleprivate', compact('training', 'private'));
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
        //  ->where('usersabonnements.end', '>=', new \DateTime('now'))->where('usersabonnements.amount', '=', NULL)->orwhere('usersabonnements.amount', '>', 0)
        $users = User::where('id', '=', $id->id)->get();
        $userabonnement = DB::table('usersabonnements')->join('abonnements', 'usersabonnements.abonnement_id', '=', 'abonnements.id')->where('usersabonnements.user_id', '=', $id->id)->get();
        $privateschedule = DB::table('privateschedule')->join('trainings', 'privateschedule.training_id', '=', 'trainings.id')->join('trainers', 'privateschedule.trainer_id', '=', 'trainers.id')->where('user_id', '=', $id->id)->select('trainings.name as training_name', 'trainers.name as trainer_name', 'privateschedule.date as privateschedule_date', 'privateschedule.endtrain as privateschedule_endtrain', 'privateschedule.id as privateschedule_id')->get();
        $trainergym2 = DB::table('traintrain')->join('trainers', 'traintrain.trainer_id', '=', 'trainers.id')->join('trainings', 'traintrain.training_id', '=', 'trainings.id')->where('training_id', '=', '1')->orwhere('training_id', '=', '2')->select('trainers.id as id', 'trainers.name as trainer_name', 'start', 'image', 'trainings.name as training_name')->get();
        $abonnement = DB::table('abonnements')->get();

        return view('admin.components.clientprofile', compact('userabonnement', 'abonnement', 'users', 'trainergym2', 'privateschedule'));
    }

    public function editprofile(User $id)
    {
        $users = User::where('id', '=', $id->id)->get();

        return view('admin.components.clientedit', compact('users', 'id'));
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
            $date1 = strtotime($date1);
        }
        if ($abonnement == '1') {
            $end = date('Y-m-d H:i:s', strtotime('+3 month', $date1));
            $amount = 0;
        } else if ($abonnement == '2') {
            $end = date('Y-m-d H:i:s', strtotime('+1 month', $date1));
            $amount = 0;
        } else if ($abonnement == '3') {
            $end = NULL;
            $amount = 1;
        } else if ($abonnement == '4') {
            $end = date('Y-m-d H:i:s', strtotime('+3 month', $date1));
            $amount = 0;
        } else if ($abonnement == '5') {
            $end = date('Y-m-d H:i:s', strtotime('+1 month', $date1));
            $amount = 0;
        } else if ($abonnement == '6') {
            $end = date('Y-m-d H:i:s', strtotime('+3 month', $date1));
            $amount = 0;
        } else if ($abonnement == '7') {
            $end = date('Y-m-d H:i:s', strtotime('+1 month', $date1));
            $amount = 0;
        } else if ($abonnement == '8') {
            $end = NULL;
            $amount = 1;
        } else if ($abonnement == '9') {
            $end = NULL;
            $amount = 1;
        } else if ($abonnement == '10') {
            $end = date('Y-m-d H:i:s', strtotime('+1 month', $date1));
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
        PrivateTraining::where('id', '=', $id->id)->update(['date' => $request->date, 'endtrain' => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($request->date))), 'checked' => 1]);
        return back();
    }

    public function checkprivateclient(PrivateTraining $id)
    {
        PrivateTraining::where('id', '=', $id->id)->update(['checked' => 1]);
        return redirect('/admin/');
    }
}
