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
                    </div> <div class="panel-body">
                        {!! $chart2->html() !!}
                    </div>

                </div>
            </div>
        </div>

        {!! Charts::scripts() !!}
        {!! $chart->script() !!}
        {!! $chart2->script() !!}
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
                    <div class="panel-body">
                        {!! $chart3->html() !!}
                    </div>
                    <div class="panel-body">
                        {!! $chart4->html() !!}
                    </div>
                    <div class="panel-body">
                        {!! $chart5->html() !!}
                    </div>
                </div>
            </div>
        </div>


        {!! $linechart->script() !!}
        {!! $chart3->script() !!}
        {!! $chart4->script() !!}
        {!! $chart5->script() !!}
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
                         
                
              
                    ?>



                </div>
            </div>
        </div>
        {!! $percentchart->script() !!}
    </div>

</div>

@endsection