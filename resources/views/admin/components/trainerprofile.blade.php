@extends('layouts.admin_layout')

@section ('style')

<link href="{{asset('packages/core/main.css')}}" rel="stylesheet" />
<link href="{{asset('packages/daygrid/main.css')}}" rel="stylesheet" />
<link href="{{asset('packages/timegrid/main.css')}}" rel="stylesheet" />
<link href="{{asset('packages/list/main.css')}}" rel="stylesheet" />
<style>
  #wrap {

    margin: 0 auto;
  }

  #external-events {
    float: left;
    width: 150px;
    padding: 0 10px;
    border: 1px solid #ccc;
    background: #eee;
    text-align: left;
  }

  #external-events h4 {
    font-size: 16px;
    margin-top: 0;
    padding-top: 1em;
  }

  #external-events .fc-event {
    margin: 10px 0;
    cursor: pointer;
  }

  #external-events p {
    margin: 1.5em 0;
    font-size: 11px;
    color: #666;
  }

  #external-events p input {
    margin: 0;
    vertical-align: middle;
  }

  #calendar {

    width: 900px;
  }
</style>
@endsection


@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="row">
        <div class="col-6">
          ФІО тренера:
        </div>
        <div class="col-6">
          <!-- small box -->
          @foreach ($trainers as $user)
          {{$user->name}}
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          Пошта тренера:
        </div>
        <div class="col-6">
          <!-- small box -->
          {{$user->email}}
        </div>
      </div>
      <div class="row">
        <div class="col">
          Мобільний номер тренера:
        </div>
        <div class="col">
          <!-- small box -->
          {{$user->phone}}
        </div>
      </div>
      <div class="row">
        <div class="col">
          Дата народження тренера:
        </div>
        <div class="col">
          <!-- small box -->
          {{$user->birth}}
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          Стаж тренера:
        </div>
        <div class="col-6">
          <!-- small box -->
          {{date('Y-m-d')-$user->start}} роки
        </div>
      </div>
    </div>
    <div class="col">
      <div class="row justify-content-center">
        <img src="{{asset($user->image)}}" height="100px">
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center text-center">



    <div class="col">
      <div class="panel panel-default">

        @if(@isset($percentchart))
        <div class="panel-body">

          {!! $percentchart->html() !!}
          <br> Кількість клієнтів, що займаються індивідуальними тренуваннями з тренерами: <b>{{$privateschedulechart}}</b><br>
          Кількість діючих клієнтів: <b>{{$abonnementchart}}</b><br>

        </div>
        @endif
        <div class="panel-body">

          {!! $percentrepeatabonnementcharttype->html() !!}

        </div>


      </div>
    </div>
    {!! Charts::scripts() !!}
    @if(@isset($percentchart))
    {!! $percentchart->script() !!}
    @endif
    {!! $percentrepeatabonnementcharttype->script() !!}
    <!-- /.card-body -->
  </div>
</div>
@if(@isset($percentchart))
<div class="container">
  <div class="row justify-content-center text-center">
    <div id='wrap'>


      <h2>Індивідуальні заняття</h2>

      <div id='external-events-list'>

      </div>

      <form>
        <div id='calendar'></div>
        <div class="form-group">

        </div>
      </form>
      <div style='clear:both'></div>

    </div>
  </div>
</div>
@endif

@endsection
@section('script')
<script src="{{asset('packages/core/main.js')}}"></script>
<script src="{{asset('packages/interaction/main.js')}}"></script>
<script src="{{asset('packages/daygrid/main.js')}}"></script>
<script src="{{asset('packages/timegrid/main.js')}}"></script>
<script src="{{asset('packages/list/main.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable

    /* initialize the external events
    -----------------------------------------------------------------*/

    var containerEl = document.getElementById('external-events-list');
    new Draggable(containerEl, {
      itemSelector: '.fc-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText.trim()
        }
      }
    });

    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
      plugins: ['interaction', 'timeGridWeek', 'timeGrid', 'list'],
      header: {
        left: '',
        right: 'today prev,next',
        center: 'title',
      },
      minTime: "09:00:00",

      maxTime: "23:00:00",
      editable: true,
      droppable: false, // this allows things to be dropped onto the calendar
      eventSources: [{
        events: [
          @foreach($privateschedule as $privateschedule) {

            id: '{{$privateschedule->privateschedule_id}}',
            title: '{{$privateschedule->user_name}}',
            start: '{{$privateschedule->privateschedule_date}}',
            end: '{{$privateschedule->privateschedule_endtrain}}',
            allDay: false
          },
          @endforeach
        ],
        color: 'greenyellow', // an option!
        textColor: 'black' // an option!
      }],
      eventDrop: function(event, delta, revertFunc) { // si changement de position

        edit(event);

      },
    });
    calendar.render();

  });

  function edit(event) {
    start = event.start.format('YYYY-MM-DD HH:mm:ss');
    if (event.end) {
      end = event.end.format('YYYY-MM-DD HH:mm:ss');
    } else {
      end = start;
    }

    id = event.id;

    Event = [];
    Event[0] = id;
    Event[1] = start;
    Event[2] = end;

    $.ajax({
      url: 'admin/schedule/group',
      type: "POST",
      data: {
        Event: Event
      },
      success: function(rep) {
        if (rep == 'OK') {
          alert('Saved');
        } else {
          alert('Could not be saved. try again.');
        }
      }
    });
  }
</script>

@endsection