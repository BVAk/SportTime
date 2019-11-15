@extends('layouts.admin_layout')

@section('content')
<div class="container-fluid">
    <form role="form" class="col-md-12 go-right" action="{{ url('/admin/insertclient') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label>Створення нового клієнта</label>
        <div class="form-group">
            <label for="name">ФІО</label>
            <input id="name" name="name" type="text" class="form-control" value="" required>

        </div>


        <div class="form-group">
            <label for="email">E-Mail</label>
            <input id="email" name="email" type="email" class="form-control" value="" required>

        </div>

        <div class="form-group">
            <label for="phone">Телефон</label>
            <input id="phone" name="phone" type="text" class="form-control" value="" required>

        </div>

        <div class="form-group">
            <label for="card">Номер картки</label>
            <input id="card" name="card" type="text" class="form-control" value="" required>
            <input id="created_at" name="created_at" type="text" hidden class="form-control" value="{{date("Y-m-d H:i:s")}}" required>

        </div>
        <div class="form-group">
            <label for="health">Стан здоров'я</label>
            <input id="health" name="health" type="text" class="form-control" value="" required>

        </div>
        <div class="form-group">
            <input class="btn btn-success center-block btn-lg" type="submit" value="Додати">
        </div>


    </form>


</div>
@endsection