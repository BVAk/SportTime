@extends('layouts.admin_layout')

@section('content')

<div class="container-fluid">

    
        @foreach ($check as $check1)
        <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h2>{{$check1->user_name}}</h2>

                <p>Зворотній зв'язок: <b>{{$check1->user_phone}}</b><br> Ім'я тренера: <b> {{$check1->trainer_name}}</b><br> Обраний час тренування: <b>{{$check1->privateschedule_date}}</b></p>
            </div>
            <a href="/admin/clients/add" class="small-box-footer">Підтвердити тренування <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
            @endforeach
    
</div>

@endsection