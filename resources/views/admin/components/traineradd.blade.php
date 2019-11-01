@extends('layouts.admin_layout')

@section('content')
<div class="container-fluid">
    <form role="form" class="col-md-12 go-right" action="{{ url('/admin/inserttrainer') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <label>Створення нового тренера</label>
        </div>
        <div class="row">
        <div class="col">

            <div class="form-group">
                <label for="name">ФІО</label>
                <input id="name" name="name" type="text" class="form-control" value="" required>

            </div>
        </div>
        <div class="col">

            <div class="form-group">
                <label for="birth">Дата народження</label>
                <input id="birth" name="birth" type="date" class="form-control" value="" required>

            </div>
        </div>
        </div>
        <div class="row">
        <div class="col">

            <div class="form-group">
                <label for="start">Початок роботи</label>
                <input id="start" name="start" type="date" class="form-control" value="" required>

            </div>
        </div>
        <div class="col">

            <div class="form-group">
                <label for="phone">Мобільний номер телефону</label>
                <input id="phone" name="phone" type="text" class="form-control" value="" required>

            </div>
        </div>
        </div>
        <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="phone">Тренування</label>

                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="col-md-6">
                            <select id="select" name="trainings[]" class="selectpicker" style="font-size: 20px;" required>
                                <option value=""> ---</option>
                                @foreach ($training as $training)
                                <option value="{{$training->id}}"> {{$training->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="photo">Фото тренера</label>
                <input type="file" name="photo"><br>
            </div>

        </div>
        </div>
        <div class="row">
        
            <div class="form-group">
                <input class="btn btn-success center-block btn-lg" type="submit" value="Додати">
            </div>
        </div>

    </form>


</div>
@endsection