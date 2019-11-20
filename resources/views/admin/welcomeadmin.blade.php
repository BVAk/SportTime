@extends('layouts.admin_layout')

@section('content')
@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="container-fluid">
<div class="row justify-content-center text-center">
  <h2>Підтвердження броні індивідуальних тренувань</h2>
</div>
  @foreach ($check as $check1)
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h2>{{$check1->user_name}}</h2>

        <p>Зворотній зв'язок: <b>{{$check1->user_phone}}</b><br> Ім'я тренера: <b> {{$check1->trainer_name}}</b><br> Обраний час тренування: <b>{{$check1->privateschedule_date}}</b></p>
      </div>
      <a href="/admin/clients/add" class="small-box-footer">Підтвердити тренування <i class="fas fa-arrow-circle-right"></i></a>
      <a id="functionEdit" class="small-box-footer" type="button" data-toggle="modal" data-target="#myModal-{{ $check1->privateschedule_id }}">Редагувати тренування <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <!-- Trigger the modal with a button -->


  <!-- Modal -->
  <div class="modal fade" id="myModal-{{ $check1->privateschedule_id }}" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Редагувати тренування</h4>
        </div>
        <div class="modal-body">
          <p>Зворотній зв'язок: <b>{{$check1->user_phone}}</b><br> Ім'я тренера: <b> {{$check1->trainer_name}}</b><br> Обраний час тренування: <b>{{$check1->privateschedule_date}}</b></p>
        </div>
        <div class="modal-footer">
          <form method="POST" action="/admin/privatechange/{{$check1->privateschedule_id}}">
            {{ csrf_field() }}
            <select id="select" name="trainer" class="selectpicker" style="font-size: 20px;" required>
              <option value=""> ---</option>
              @foreach ($trainergym2 as $training)
              <option value="{{$training->id}}"> {{$training->trainer_name}}</option>
              @endforeach
            </select>
            <input id="date" name="date" type="datetime-local" class="form-control" value="{{$check1->privateschedule_date}}" required>
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
            <button type="submit" class="btn btn-danger">
              <i class="fa fa-times-circle"></i> Відрегувати
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>

  @endforeach

</div>
<div class="container-fluid">
<div class="row justify-content-center text-center">
  <h2>Відмітити клієнта</h2>
</div>
<div class="row justify-content-center text-center">
  <form method="POST" action="/admin/addvisit">
    {{ csrf_field() }}
    <div class="form-group">
      <input id="usercard" name="usercard" class="form-control" type="text" value="" placeholder="Введіть номер картки">
    </div>
    <div class="form-group">
      <label class="form-control"> або </label></div>
    <div class="form-group">
      <input id="userphone" name="userphone" class="form-control" value="" placeholder="Введіть мобільний номер"></div>
    <div class="form-group">
      <input class="btn btn-warning center-block btn-lg" type="submit" value="Відмітити">
    </div>
  </form>

  
</div>
</div>



@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
  document.getElementById("functionEdit").onclick = function() {
  $('#myModal').modal('show');
  });
</script>
@endsection