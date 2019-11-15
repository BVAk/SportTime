@extends('layouts.admin_layout')

@section('content')
<div class="container-fluid">
    <form role="form" class="col-md-12 go-right" action="/admin/inserteditclient/{{$id->id}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label>Редагування даних клієнта</label>
        <div class="form-group">
            <label for="name">ФІО</label>
            <input id="name" name="name" type="text" class="form-control" value="{{$id->name}}" required>

        </div>


        <div class="form-group">
            <label for="email">E-Mail</label>
            <input id="email" name="email" type="email" class="form-control" value="{{$id->email}}" required>

        </div>

        <div class="form-group">
            <label for="phone">Телефон</label>
            <input id="phone" name="phone" type="text" class="form-control" value="{{$id->phone}}" required>

        </div>

        <div class="form-group">
            <label for="card">Номер картки</label>
            <input id="card" name="card" type="text" class="form-control" value="{{$id->card}}" required>
            
        </div>
        <div class="form-group">
            <label for="health">Стан здоров'я</label>
            <input id="health" name="health" type="text" class="form-control" value="{{$id->health}}" required>

        </div>
        <div class="form-group">
            <input class="btn btn-success center-block btn-lg" type="submit" value="Зберегти зміни">
        </div>


    </form>


</div>
@endsection