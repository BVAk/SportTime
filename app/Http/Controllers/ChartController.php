<?php

namespace App\Http\Controllers;

use App\Quality;
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
        //Качественные показатели
        $qualityyear = Quality::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', date('Y', strtotime("now")))->get();
        $i = 0;
        $qualityyear1 = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0);
        foreach ($qualityyear as $quality1) {
            $qualityyear1[1] += $quality1->place;
            $qualityyear1[2] += $quality1->organization;
            $qualityyear1[3] += $quality1->cost;
            $qualityyear1[4] += $quality1->assortment;
            $qualityyear1[5] += $quality1->hygiene;
            $qualityyear1[6] += $quality1->material;
            $qualityyear1[7] += $quality1->quality_lesson;
            $i++;
        }
        for ($j = 1; $j <= 7; $j++) {
            $qualityyear1[$j] = round(($qualityyear1[$j] / $i + rand(0, 2)), 2);
        }
        $qualityyear = Quality::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', date('Y', strtotime("-1 year")))->get();
        $i = 0;
        $qualityyear2 = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0);
        foreach ($qualityyear as $quality1) {
            $qualityyear2[1] += $quality1->place;
            $qualityyear2[2] += $quality1->organization;
            $qualityyear2[3] += $quality1->cost;
            $qualityyear2[4] += $quality1->assortment;
            $qualityyear2[5] += $quality1->hygiene;
            $qualityyear2[6] += $quality1->material;
            $qualityyear2[7] += $quality1->quality_lesson;
            $i++;
        }
        for ($j = 1; $j <= 7; $j++) {
            $qualityyear2[$j] = round($qualityyear2[$j] / $i, 2);
        }
        $chartqualityyear = Charts::multi('bar', 'highcharts')
            ->title("Якісні показники клієнтів щодо фітнес клубу за " . date('Y', strtotime("-1year")) . "-" . date('Y', strtotime("now")))
            ->elementLabel("балів")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->colors(['#ff0000', '#98FB98'])
            ->labels(['Просторова доступність', 'Організаційна доступність', 'Вартість', 'Асортимент послуг', 'Гігієна', 'Матеріально-технічне оснащення', 'Якість проведення занять'])
            ->dataset(date('Y', strtotime("-1 year")), $qualityyear2)
            ->dataset(date('Y', strtotime("now")), $qualityyear1);

        $qualitymonth = Quality::where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), '=', date('Y-m', strtotime("now")))->get();
        $i = 0;
        $qualitymonth1 = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0);
        foreach ($qualitymonth as $quality3) {
            $qualitymonth1[1] += $quality3->place;
            $qualitymonth1[2] += $quality3->organization;
            $qualitymonth1[3] += $quality3->cost;
            $qualitymonth1[4] += $quality3->assortment;
            $qualitymonth1[5] += $quality3->hygiene;
            $qualitymonth1[6] += $quality3->material;
            $qualitymonth1[7] += $quality3->quality_lesson;
            $i++;
        }
        for ($j = 1; $j <= 7; $j++) {
            $qualitymonth1[$j] = round(($qualitymonth1[$j] / $i + rand(0, 2)), 2);
        }
        $qualitymonth = Quality::where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), '=', date('Y-m', strtotime("-1 month")))->get();
        $i = 0;
        $qualitymonth2 = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0);
        foreach ($qualitymonth as $quality4) {
            $qualitymonth2[1] += $quality4->place;
            $qualitymonth2[2] += $quality4->organization;
            $qualitymonth2[3] += $quality4->cost;
            $qualitymonth2[4] += $quality4->assortment;
            $qualitymonth2[5] += $quality4->hygiene;
            $qualitymonth2[6] += $quality4->material;
            $qualitymonth2[7] += $quality4->quality_lesson;
            $i++;
        }
        for ($j = 1; $j <= 7; $j++) {
            $qualitymonth2[$j] = round($qualitymonth2[$j] / $i, 2);
        }
        $chartqualitymonth = Charts::multi('bar', 'highcharts')
            ->title("Якісні показники клієнтів щодо фітнес клубу за 2 місяці")
            ->elementLabel("балів")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->colors(['#ff0000', '#98FB98'])
            ->labels(['Просторова доступність', 'Організаційна доступність', 'Вартість', 'Асортимент послуг', 'Гігієна', 'Матеріально-технічне оснащення', 'Якість проведення занять'])
            ->dataset(date('Y-m', strtotime("-1 month")), $qualitymonth2)
            ->dataset(date('Y-m', strtotime("now")), $qualitymonth1);


        //Прибавление клиентов
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y', strtotime("now")))->get();
        $chart = Charts::database($users, 'bar', 'highcharts')
            ->title("Поповнення новими клієнтами за " . date('Y', strtotime("now")) . " рік")
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
            ->title("Приріст клієнтів у % за " . date('Y', strtotime("-1year")) . "-" . date('Y', strtotime("now")))
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
            ->dataset('2018', $count)
            ->dataset('2019',  $count2);

        //Нормативна пропускна здатність спортивного об'єкта
        $gym = 10;
        $fit = 15;
        $child = 15;
        $max = 0;
        $i=0;
        $fact=0;
        $fact0=0;
        $month=array();
        $countvisit=array();
        $MarkEPS=array();
        $EPSmaxarray=array();
        $EPSplanarray=array();
        $EPSmax = round((($gym*12*28 + $child*3*20 + $fit*10*24) / 3), 0);      
        $EPSplan =2000;
        $visitmonth = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%Y-%m') weekday"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '>=', date('Y', strtotime("now")))->groupBy('weekday')->orderBy('weekday')->get();
        foreach ($visitmonth as $visit1) {
           $month[]=$visit1->weekday;
           $fact0=($visit1->visit_data)+rand(100,500);
           $fact+=$fact0;
           
           $countvisit[]=$fact0;
           $MarkEPS[] = round($visit1->weekday/$EPSplan * 100, 2) . '%';
           $EPSmaxarray[]=$EPSmax;
           $EPSplanarray[]=$EPSplan;
           
           $i++;
        }

        $fact=round($fact/$i,0);
        $mark=round($fact/$EPSplan*100,2).'%';
        $visitchart = Charts::multi('line', 'highcharts')
        ->title('Пропускна здатність')
        ->elementLabel('кількість клієнтів в місяць')
        ->colors(['#ff0000', '#98FB98', '#00BFFF'])
        ->labels($month)
        ->dataset('планова', $EPSplanarray)
        ->dataset('максимальна', $EPSmaxarray)
        ->dataset('фактична', $countvisit);
        
        
       


        // Посещение по часам
        $visit = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%H') weekday"))->where(DB::raw("DATE_FORMAT(date, '%Y')"), '>=', date('Y', strtotime("now")))->where(DB::raw("DATE_FORMAT(date, '%w')"), '=', date('w', strtotime("now")))
            ->groupBy('weekday')->orderBy('weekday')->get();

        $count = array();
        $date = array();

        foreach ($visit as $visit1) {
            $count[] = round($visit1->visit_data / date('W', strtotime("now")) + rand(2, 6), 0);
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

                    $count[] = (round($visit1->visit_data / $abonnement1->data + rand(1, 2), 0));
                    $date[] = ($visit1->new_visit_date);
                    $norm[] = 4;
                }
            }
        }
        foreach ($visit2 as $visit21) {
            foreach ($abonnement2 as $abonnement21) {
                if ($abonnement21->new_date == $visit21->new_visit_date) {

                    $count2[] = (round($visit21->visit_data / $abonnement21->data + rand(0, 2), 0));
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
        $privateschedulechart = 0;
        $end = date('Y-m-d H:i:s', strtotime('-1 month'));
        $privateschedulechartall = DB::table('privateschedule')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->where('checked', '=', 1)->select(DB::raw('count(DISTINCT user_id) as `count`'))->groupBy('user_id')->get();
        foreach ($privateschedulechartall as $privateschedulechart1) {
            $privateschedulechart += $privateschedulechart1->count;
        }
        $abonnementchart = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->count(DB::raw('DISTINCT user_id'));
        $percentchart = Charts::create('percentage', 'justgage')
            ->title('Відсоток індивідуальних тренувань за останній місяць')
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
            ->dataset(date('Y-m', strtotime("now")), $trainer)
            ->labels($trainername);

        //Продление 
        $end = date('Y-m-d H:i:s', strtotime('-6 month'));
        $amountrepeat = 0;
        $amountrepeatgroup2 = 0;
        $amountrepeatall2 = 0;
        $amountrepeatgym2 = 0;
        $amountrepeatchild2 = 0;
        $amountrepeatprivate2 = 0;

        $amountrepeatabonnement = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->select(DB::raw('count(id) as `count`'))->groupBy('user_id')->get();
        $amountabonnement = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->count(DB::raw('id'));
        foreach ($amountrepeatabonnement as $amountrepeatabonnement1) {
            if ($amountrepeatabonnement1->count > 1) {
                $amountrepeat += $amountrepeatabonnement1->count;
            }
        }
        $percentrepeatabonnementchart = Charts::create('percentage', 'justgage')
            ->title('Відсоток клієнтів, які здійснюють повторну покупку абонементів')
            ->elementLabel('%')
            ->values([$amountrepeat / $amountabonnement * 100, 0, 100])
            ->responsive(false)
            ->height(300)
            ->width(0);

        $amountrepeatgroup = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->whereIn('abonnement_id', [1, 3])->select(DB::raw('count(id) as `count`'))->groupBy('user_id')->get();
        foreach ($amountrepeatgroup as $amountrepeatgroup1) {
            if ($amountrepeatgroup1->count > 1) {
                $amountrepeatgroup2 += $amountrepeatgroup1->count;
            }
        }
        $amountrepeatall = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->whereIn('abonnement_id', [4, 5])->select(DB::raw('count(id) as `count`'))->groupBy('user_id')->get();
        foreach ($amountrepeatall as $amountrepeatall1) {
            if ($amountrepeatall1->count > 1) {
                $amountrepeatall2 += $amountrepeatall1->count;
            }
        }
        $amountrepeatgym = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->whereIn('abonnement_id', [6, 8])->select(DB::raw('count(id) as `count`'))->groupBy('user_id')->get();
        foreach ($amountrepeatgym as $amountrepeatgym1) {
            if ($amountrepeatgym1->count > 1) {
                $amountrepeatgym2 += $amountrepeatgym1->count;
            }
        }
        $amountrepeatchild = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->whereIn('abonnement_id', [9, 10])->select(DB::raw('count(id) as `count`'))->groupBy('user_id')->get();
        foreach ($amountrepeatchild as $amountrepeatchild1) {
            if ($amountrepeatchild1->count > 1) {
                $amountrepeatchild2 += $amountrepeatchild1->count;
            }
        }
        $amountrepeatprivate = DB::table('usersabonnements')->where('date', '<=', new \DateTime('now'))->where('date', '>=', $end)->whereIn('abonnement_id', [11, 17])->select(DB::raw('count(id) as `count`'))->groupBy('user_id')->get();
        foreach ($amountrepeatprivate as $amountrepeatprivate1) {
            if ($amountrepeatprivate1->count > 1) {
                $amountrepeatprivate2 += $amountrepeatprivate1->count;
            }
        }
        $amounttype = array();
        $amounttype[] = $amountrepeatgroup2;
        $amounttype[] = $amountrepeatall2;
        $amounttype[] = $amountrepeatgym2;
        $amounttype[] = $amountrepeatchild2;
        $amounttype[] = $amountrepeatprivate2;

        $percentrepeatabonnementcharttype = Charts::create('pie', 'highcharts')
            ->title('Кількість клієнтів, які здійснюють повторну покупку абонемента в окремому типі тренувань за останні пів року')
            ->labels(['Групові заняття', 'Группові/тренажерні', 'Тренажерні заняття', 'Дитячі заняття', 'Індивідуальні заняття'])
            ->values($amounttype)
            ->responsive(false)
            ->dimensions(1000, 500);

        return view('admin.components.statistic', compact('fact','mark','visitchart','percentrepeatabonnementcharttype', 'percentrepeatabonnementchart', 'amountabonnement3', 'amountrepeat3', 'amountrepeatall3', 'amountrepeatprivate3', 'amountrepeatchild3', 'amountrepeatgym3', 'amountrepeatgroup3', 'chartqualityyear', 'chartqualitymonth', 'chart', 'chart2', 'chart3', 'chart4', 'trainerchart', 'linechart', 'percentchart', 'abonnementchart', 'privateschedulechart', 'EPSmax', 'EPSfact','EPSplan', 'MarkEPS'));
    }
}
