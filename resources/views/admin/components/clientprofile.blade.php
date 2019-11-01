@extends('layouts.admin_layout')
@section('content')

<div class="container-fluid">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @foreach ($users as $user)
    {{$user->name}}
    @endforeach
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="container">
      <div class="row justify-content-center text-center">
        <form role="form" class="col-md-6 col-lg-4 mb-4 go-right" action="{{ url('/fitness/trainers/privatetrainer') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <h2 class="text-white"><b>Обрати тренера</b></h2>
            <div class="panel panel-default">
              <div class="panel-body">

                <select id="select" name="trainer" class="selectpicker" style="font-size: 20px;" required>
                  <option value=""> ---</option>
                  @foreach ($trainergym2 as $training)
                  <option value="{{$training->id}}"> {{$training->trainer_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <h2 class="text-white"><b>Обрати дату і час тренування</b></h2>
            <input id="datetrain" name="datetrain" type="datetime-local" class="form-control" value="" required>
          </div>
          
          <input id="user" name="user" type="hidden" class="form-control" value="{{$user->id }}" required>
          
          <div class="form-group">
            <input class="btn btn-success center-block btn-lg" type="submit" value="Зареєструвати тренування">
          </div>


        </form>
      </div>
    </div>
  </div>
</div>

@endsection