@extends('layouts.admin_layout')

@section('content')

<div class="container-fluid">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">

        <div class="card-body">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Реєстрація нових клієнтів</div>

                    <div class="panel-body">
                        {!! $chart->html() !!}
                    </div>

                </div>
            </div>
        </div>

        {!! Charts::scripts() !!}
        {!! $chart->script() !!}
        <!-- /.card-body -->
    </div>
    <div class="card">

        <div class="card-body">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Відвідування занять</div>

                    <div class="panel-body">
                        {!! $linechart->html() !!}
                    </div>
                </div>
            </div>
        </div>


        {!! $linechart->script() !!}
        <!-- /.card-body -->
    </div>

    <div class="card">

        <div class="card-body">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Персональні тренування</div>

                    <div class="panel-body">
                        Кількість клієнтів, що займаються індивідуальними тренуваннями з тренерами: {{$privateschedulechart}}<br>
                        Кількість діючих клієнтів:{{$abonnementchart}}<br>
                  
                        {!! $percentchart->html() !!}

                    </div>
                    <?php
                                   
                
                    $user = DB::table('usersabonnements')->get();
                    $groupschedule = DB::table('groupshedule')->where('room_id', '=', '2')->get();
                    foreach ($user as $user1) {
                        if ($user1->abonnement_id == '1' or '2' or '4' or '5') {
                            $start = strtotime($user1->date);
                            $end = ($user1->end);
                            $train = rand(0, 23);
                            $groupschedule = DB::table('groupshedule')->where('room_id', '=', '2')->where('id', '=', $train)->first();
                            $starttrain = strtotime($groupschedule->start);
                            $endtrain = strtotime($groupschedule->end);

                            $countweek = '-' . date('w', $starttrain - $start) . ' week';
                            $date = date('Y-m-d H:i:s', strtotime($countweek, $starttrain));
                            echo ('Skolko nedel ' . $countweek . ' ');
                            echo ('Trenirovka ' . $groupschedule->id . ' ');
                            echo ('Nomer abonementa' . $user1->id . ' ');
                            echo ('Visiting data' . $date . '');
                            break;
                        }
                    }

                    ?>



                </div>
            </div>
        </div>
        {!! $percentchart->script() !!}
    </div>

</div>

@endsection