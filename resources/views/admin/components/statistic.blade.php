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
                    <div class="panel-body">
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
                    <div class="panel-heading">Якісні показники</div>

                    <div class="panel-body">
                        {!! $chartqualityyear->html() !!}
                    </div>
                    <div class="panel-body">
                        {!! $chartqualitymonth->html() !!}
                    </div>

                </div>
            </div>
        </div>


        {!! Charts::scripts() !!}
        {!! $chartqualityyear->script() !!}
        {!! $chartqualitymonth->script()!!}

        <!-- /.card-body -->
    </div>
    <div class="card">

        <div class="card-body">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Відвідування занять</div>
                    <div class="panel-body">
                    {!! $visitchart->html() !!}
                    <br>
                    Максимальна пропускна здатність спортивного об'єкта {{$EPSmax}} люд/місяць<br>
                    Планова пропускна здатність спортивного об'єкта {{$EPSplan}} люд/місяць<br>
                    Фактична пропускна здатність спортивного об'єкта {{$fact}} люд/місяць<br>
                    Оцінка завантаження {{$mark}}<br>
                    
                    </div>
                    
                    <div class="panel-body">
                        {!! $linechart->html() !!}
                    </div>
                    <div class="panel-body">
                        {!! $chart3->html() !!}
                    </div>
                    <div class="panel-body">
                        {!! $chart4->html() !!}
                    </div>
                </div>
            </div>
        </div>


        {!! $linechart->script() !!}
        {!! $chart3->script() !!}
        {!! $chart4->script() !!}
        {!! $visitchart->script()!!}

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
                        {!!$trainerchart->html()!!}

                    </div>
                    <?php



                    ?>



                </div>
            </div>
        </div>
        {!! $percentchart->script() !!}
        {!! $trainerchart->script() !!}
    </div>

    <div class="card">

        <div class="card-body">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Втримання клієнтів</div>

                    <div class="panel-body">

                        {!! $percentrepeatabonnementchart->html() !!}
                        {!! $percentrepeatabonnementcharttype->html() !!}
                    
                    </div>
                    <?php



                    ?>



                </div>
            </div>
        </div>
        {!! $percentrepeatabonnementchart->script() !!}
        {!! $percentrepeatabonnementcharttype->script() !!}

    </div>

</div>

@endsection