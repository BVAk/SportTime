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
                  
                                   
                  $visit = DB::table('visiting')->select(DB::raw('count(id) as `visit_data`'), DB::raw("DATE_FORMAT(date, '%Y-%m') new_visit_date"))
                  ->groupBy('new_visit_date')->orderBy('new_visit_date')->get();
      
              $abonnement = DB::table('usersabonnements')->select(DB::raw('count(DISTINCT user_id) as `data`'), DB::raw("DATE_FORMAT(date, '%Y-%m') new_date"))
                  ->groupBy('new_date')->orderBy('new_date')->get();
      
      
      
              foreach ($visit as $visit1) {
                  foreach ($abonnement as $abonnement1) {
                      if ($abonnement1->new_date == $visit1->new_visit_date) {
      echo ($visit1->visit_data.'/ ');
      echo($abonnement1->data.'= ');
                          echo (round($visit1->visit_data / $abonnement1->data, 0) . ' in ');
                          echo ($visit1->new_visit_date.' ');
                      }
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