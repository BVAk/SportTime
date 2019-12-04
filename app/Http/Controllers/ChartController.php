<?php

namespace App\Http\Controllers;

use App\Trainer;
use App\Training;
use App\User;
use App\PrivateTraining;
use App\Visit;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Facades\Charts;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ChartController extends Controller
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
            ->elementLabel("К-сть нових клієнтів")
            ->dimensions(1000, 500)
            ->colors(['#98FB98'])
            ->responsive(false)
            ->groupByMonth(date('Y'), true);

        // Темп приросту  
       //2019
        $users = User::select(DB::raw('count(id) as `count_user`'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') new_user_date"))->groupBy('new_user_date')->orderBy('new_user_date')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), '>=', date('Y', strtotime("now")))->get();
       //до 2019
        $users2 = User::select(DB::raw('count(id) as `count_user`'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') new_user_date"))->groupBy('new_user_date')->orderBy('new_user_date')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), '<', date('Y', strtotime("now")))->get();
       
       $count=0;
        foreach ($users2 as $user2) {
            $count += $user2->count_user;}

        foreach ($users as $user) {
            $count += $user->count_user;

            if ($count - $user->count_user != 0) {
                $percent[] = (round(((($count) / ($count - $user->count_user)) * 100 - 100), 0));
                $date[] = ($user->new_user_date);
            }
        }
        $chart2 = Charts::database($users, 'bar', 'highcharts')
            ->title("Приріст клієнтів у %")
            ->elementLabel("% нових клієнтів")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->colors(['#FFA500'])
            ->groupByMonth(date('Y'), true)
            ->labels($date)
            ->values($percent);

        // Посещение по дням
        $visit = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%w-%W') weekday"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '>=', date('Y', strtotime("now")))
            ->groupBy('weekday')->orderBy('weekday')->get();
            $visit2 = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%w-%W') weekday"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '>=', date('Y', strtotime("-1 year")))
            ->groupBy('weekday')->orderBy('weekday')->get();
            foreach ($visit2 as $visit21) {


                $count2[] = round($visit21->visit_data / date('W', strtotime("now")), 0);
                
            }
        $count = array();
        $date = array();

        foreach ($visit as $visit1) {


            $count[] = round($visit1->visit_data / date('W', strtotime("now")), 0);
            $date[] = ($visit1->weekday);
        }
        $chart3 = Charts::database($users, 'bar', 'highcharts')
            ->title("Зайнятість по дням у " . date('Y', strtotime("now")) . " році")
            ->elementLabel("клієнтів")

            ->colors(['#98FB98'])
            ->dimensions(1000, 500)
            ->responsive(false)
            ->groupByMonth(date('Y'), true)
            ->labels($date)
            ->values($count);

            $chart5 = Charts::multi('areaspline', 'highcharts')
            ->title('My nice chart')
            ->colors(['#ff0000', '#ffffff'])
            ->labels($date)
            ->dataset('2018', $count2)
            ->dataset('2019',  $count);
      /*  $chart5 = Charts::multi('areaspline', 'highcharts')
            ->title('My nice chart')
            ->colors(['#ff0000', '#ffffff'])
            ->labels(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'])
            ->dataset('John', [3, 4, 3, 5, 4, 10, 12])
            ->dataset('Jane',  [1, 3, 4, 3, 3, 5, 4]);
*/

        // Посещение по часам
        $visit = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%H') weekday"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '>=', date('Y', strtotime("now")))->where(DB::raw("DATE_FORMAT(date, '%w')"), '=', date('w', strtotime("now")))
            ->groupBy('weekday')->orderBy('weekday')->get();

        $count = array();
        $date = array();

        foreach ($visit as $visit1) {


            $count[] = round($visit1->visit_data / date('W', strtotime("now")), 0);
            $date[] = ($visit1->weekday);
        }
        $chart4 = Charts::database($users, 'bar', 'highcharts')
            ->title("Зайнятість по годинам у " . date('D', strtotime("now")) . "  ")
            ->elementLabel("клієнтів")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->colors(['#FFA500'])
            ->groupByMonth(date('H'), true)
            ->labels($date)
            ->values($count);


        //Середня кількість відвідувань
        $visit = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%Y-%m') new_visit_date"))
            ->groupBy('new_visit_date')->orderBy('new_visit_date')->get();

        $abonnement = DB::table('usersabonnements')->select(DB::raw('count(DISTINCT user_id) as `data`'), DB::raw("DATE_FORMAT(date, '%Y-%m') new_date"))
            ->groupBy('new_date')->orderBy('new_date')->get();

        $count = array();
        $date = array();

        foreach ($visit as $visit1) {
            foreach ($abonnement as $abonnement1) {
                if ($abonnement1->new_date == $visit1->new_visit_date) {

                    $count[] = (round($visit1->visit_data / $abonnement1->data, 0));
                    $date[] = ($visit1->new_visit_date);
                }
            }
        }
        $linechart = Charts::create('line', 'highcharts')
            ->title('Середня кількість відвідувань')
            ->elementLabel('Середня кількість відвідувань 1 людини в місяць')
            ->labels($date)
            ->values($count)
            ->dimensions(1000, 500)
            ->responsive(false);



        // Індивідуальні тренування

        $end = date('Y-m-d H:i:s', strtotime('-1 month'));
        $privateschedulechart = DB::table('privateschedule')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->count(DB::raw('DISTINCT user_id'));
        $abonnementchart = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->count(DB::raw('DISTINCT user_id'));
        $percentchart = Charts::create('percentage', 'justgage')
            ->title('Відсоток індивідуальних тренувань')
            ->elementLabel('%')
            ->values([$privateschedulechart / $abonnementchart * 100, 0, 100])
            ->responsive(false)
            ->height(300)
            ->width(0);


        return view('admin.components.statistic', compact('chart', 'chart2', 'chart3', 'chart4', 'chart5', 'linechart', 'percentchart', 'abonnementchart', 'privateschedulechart'));
    }}
