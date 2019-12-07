<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Facades\Charts;

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
        //Прибавление клиентов
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y', strtotime("now")))->get();
        $chart = Charts::database($users, 'bar', 'highcharts')
            ->title("Поповнення новими клієнтами")
            ->elementLabel("К-сть нових клієнтів")
            ->dimensions(1000, 500)
            ->colors(['#98FB98'])
            ->responsive(false)
            ->groupByMonth(date('Y'), true);

        // Темп приросту  
        //в 2019
        $users2019 = User::select(DB::raw('count(id) as `count_user`'), DB::raw("DATE_FORMAT(created_at, '%m-%M') new_user_date"))->groupBy('new_user_date')->orderBy('new_user_date')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', date('Y', strtotime("now")))->get();
        //до 2019
        $users20192 = User::select(DB::raw('count(id) as `count_user`'), DB::raw("DATE_FORMAT(created_at, '%m-%M') new_user_date"))->groupBy('new_user_date')->orderBy('new_user_date')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), '<', date('Y', strtotime("now")))->get();
        //в 2018
        $users2018 = User::select(DB::raw('count(id) as `count_user`'), DB::raw("DATE_FORMAT(created_at, '%m-%M') new_user_date"))->groupBy('new_user_date')->orderBy('new_user_date')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', date('Y', strtotime("-1 year")))->get();
        //до 2018
        $users20182 = User::select(DB::raw('count(id) as `count_user`'), DB::raw("DATE_FORMAT(created_at, '%m-%M') new_user_date"))->groupBy('new_user_date')->orderBy('new_user_date')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), '<', date('Y', strtotime("-1 year")))->get();

        $count = 0;
        foreach ($users20192 as $user20192) {
            $count += $user20192->count_user;
        }
        foreach ($users2019 as $user) {
            $count += $user->count_user;
            if ($count - $user->count_user != 0) {
                $percent[] = (round(((($count) / ($count - $user->count_user)) * 100 - 100), 0));
                $date[] = ($user->new_user_date);
            }
        }
        $count2018 = 0;
        foreach ($users20182 as $user20182) {
            $count2018 += $user20182->count_user;
        }
        foreach ($users2018 as $user20181) {
            $count2018 += $user20181->count_user;
            if ($count2018 - $user20181->count_user != 0) {
                $percent2018[] = (round(((($count2018) / ($count2018 - $user20181->count_user)) * 100 - 100), 0));
            }
        }
        $chart2 = Charts::multi('bar', 'highcharts')
            ->title("Приріст клієнтів у %")
            ->elementLabel("% нових клієнтів")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->colors(['#ff0000', '#98FB98'])
            ->labels($date)
            ->dataset('2018', $percent2018)
            ->dataset('2019',  $percent);

        // Посещение по дням
        $visit = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%w-%W') weekday"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '>=', date('Y', strtotime("now")))
            ->groupBy('weekday')->orderBy('weekday')->get();
        $visit2 = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%w-%W') weekday"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '>=', date('Y', strtotime("-1 year")))
            ->groupBy('weekday')->orderBy('weekday')->get();
        foreach ($visit2 as $visit21) {


            $count2[] = round($visit21->visit_data / 52, 0);
        }
        $count = array();
        $date = array();

        foreach ($visit as $visit1) {


            $count[] = round($visit1->visit_data / date('W', strtotime("now")), 0);
            $date[] = ($visit1->weekday);
        }
        $chart3 =  Charts::multi('bar', 'highcharts')
            ->title("Зайнятість по дням")
            ->elementLabel("кількість клієнтів")
            ->colors(['#ff0000', '#98FB98'])
            ->labels($date)
            ->dataset('2018', $count2)
            ->dataset('2019',  $count);

        // Посещение по часам
        $visit = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%H') weekday"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '>=', date('Y', strtotime("now")))->where(DB::raw("DATE_FORMAT(date, '%w')"), '=', date('w', strtotime("now")))
            ->groupBy('weekday')->orderBy('weekday')->get();

        $count = array();
        $date = array();

        foreach ($visit as $visit1) {


            $count[] = round($visit1->visit_data / date('W', strtotime("now")), 0);
            $date[] = ($visit1->weekday + 1) . ':00-' . ($visit1->weekday + 2) . ':00';
        }
        $chart4 = Charts::database($users, 'bar', 'highcharts')
            ->title("Зайнятість по годинам у " . date('D', strtotime("now")) . "  за 2019 рік")
            ->elementLabel("кількість клієнтів")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->colors(['#FFA500'])
            ->groupByMonth(date('H'), true)
            ->labels($date)
            ->values($count);


        //Середня кількість відвідувань
        $visit = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%m-%M') new_visit_date"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '=', date('Y', strtotime("now")))
            ->groupBy('new_visit_date')->orderBy('new_visit_date')->get();

        $abonnement = DB::table('usersabonnements')->select(DB::raw('count(DISTINCT user_id) as `data`'), DB::raw("DATE_FORMAT(date, '%m-%M') new_date"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '=', date('Y', strtotime("now")))
            ->groupBy('new_date')->orderBy('new_date')->get();
        $visit2 = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%m-%M') new_visit_date"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '=', date('Y', strtotime("-1 year")))
            ->groupBy('new_visit_date')->orderBy('new_visit_date')->get();

        $abonnement2 = DB::table('usersabonnements')->select(DB::raw('count(DISTINCT user_id) as `data`'), DB::raw("DATE_FORMAT(date, '%m-%M') new_date"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '=', date('Y', strtotime("-1 year")))
            ->groupBy('new_date')->orderBy('new_date')->get();

        $count = array();
        $date = array();
        $count2 = array();

        foreach ($visit as $visit1) {
            foreach ($abonnement as $abonnement1) {
                if ($abonnement1->new_date == $visit1->new_visit_date) {

                    $count[] = (round($visit1->visit_data / $abonnement1->data, 0));
                    $date[] = ($visit1->new_visit_date);
                    $norm[] = 4;
                }
            }
        }
        foreach ($visit2 as $visit21) {
            foreach ($abonnement2 as $abonnement21) {
                if ($abonnement21->new_date == $visit21->new_visit_date) {

                    $count2[] = (round($visit21->visit_data / $abonnement21->data, 0));
                }
            }
        }
        $linechart = Charts::multi('line', 'highcharts')
            ->title('Середня кількість відвідувань')
            ->elementLabel('Середня кількість відвідувань 1 людини в місяць')
            ->colors(['#ff0000', '#98FB98', '#00BFFF'])
            ->labels($date)
            ->dataset('норматив', $norm)
            ->dataset('2018', $count2)
            ->dataset('2019', $count);




        // Індивідуальні тренування

        $end = date('Y-m-d H:i:s', strtotime('-1 month'));
        $privateschedulechart = DB::table('privateschedule')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->where('checked', '=', 1)->count(DB::raw('DISTINCT user_id'));
        $abonnementchart = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->count(DB::raw('DISTINCT user_id'));
        $percentchart = Charts::create('percentage', 'justgage')
            ->title('Відсоток індивідуальних тренувань')
            ->elementLabel('%')
            ->values([$privateschedulechart / $abonnementchart * 100, 0, 100])
            ->responsive(false)
            ->height(300)
            ->width(0);
        $privateschedulecharttrainers = DB::table('privateschedule')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->where('checked', '=', 1)->select(DB::raw('count(DISTINCT user_id) as `count`'), DB::raw('trainer_id'))->groupBy('trainer_id')->orderbyDESC('count')->get();
        foreach ($privateschedulecharttrainers as $privateschedulecharttrainers1) {
            $trainer[] = $privateschedulecharttrainers1->count;
            $trainer_name = DB::table('trainers')->where('id', '=', $privateschedulecharttrainers1->trainer_id)->get();
            foreach ($trainer_name as $traner_name) {
                $trainername[] = $traner_name->name;
            }
        }


        $trainerchart = Charts::multi('bar', 'highcharts')
            ->title("Індивідуальні тренування тренерів")
            ->elementLabel("кількість клієнтів")
            ->colors(['#FFA500'])
            ->dataset('2019', $trainer)
            ->labels($trainername);

        return view('admin.components.statistic', compact('chart', 'chart2', 'chart3', 'chart4', 'trainerchart', 'linechart', 'percentchart', 'abonnementchart', 'privateschedulechart'));
    }
}
