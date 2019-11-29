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
{!! $chart->script() !!}<!-- /.card-body -->
            </div>
            <div class="card">
              
              <div class="card-body">
              <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Відвідування занять</div>

                <div class="panel-body">
                    {!! $chart2->html() !!}
                </div>
            </div>
        </div>
              </div>
              

{!! $chart2->script() !!}<!-- /.card-body -->
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
              

{!! $linechart->script() !!}<!-- /.card-body -->
            </div>
            
      </div>
 
@endsection