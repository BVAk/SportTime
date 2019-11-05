@extends('layouts.admin_layout')


@section ('style')

<link href="{{asset('packages/core/main.css')}}" rel="stylesheet"/>
<link href="{{asset('packages/daygrid/main.css')}}" rel="stylesheet" />
<link href="{{asset('packages/timegrid/main.css')}}" rel="stylesheet" />
<link href="{{asset('packages/list/main.css')}}" rel="stylesheet" />
<style>
#wrap {
    width: 1100px;
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
    float: right;
    width: 900px;
  }

</style>
@endsection



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
            <h2>Обрати тренера</h2>
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
            <h2>Обрати дату і час тренування</h2>
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


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div id='wrap'>

<div id='external-events'>
  <h4>Групові заняття</h4>

  <div id='external-events-list'>
    @foreach($trainergym2 as $training)
    <div class='fc-event'>{{$training->trainer_name}}</div>
    @endforeach
  </div>
</div>
<form >
<div id='calendar'></div>
<div class="form-group">

<button class="btn btn-success btn-submit">Submit</button>

</div>
</form>
<div style='clear:both'></div>

</div>
            </div>
            <!-- /.card -->
        </div>
    </div>


@endsection
@section ('script')

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
        right: '',
        center: 'title',
      },
      minTime: "09:00:00",
      maxTime: "22:00:00",
      editable: false,
      droppable: true, // this allows things to be dropped onto the calendar
      eventSources: [{
        events: [
          @foreach($privateschedule as $privateschedule1) {

            id: '{{$privateschedule1->privateschedule_id}}',
            title: '{{$privateschedule1->training_name}}',
            start: '{{$privateschedule1->privateschedule_date}}',
            end: '{{$privateschedule1->privateschedule_endtrain}}',
            allDay: false
          },

          @endforeach
        ],
        eventClick: function(info) {
          alert('Event: ' + info.event.title);
          alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
          alert('View: ' + info.view.type);

          // change the border color just for fun
          info.el.style.borderColor = 'red';
        },

        color: 'greenyellow', // an option!
        textColor: 'black' // an option!
      }],
      eventDrop: function(event, delta, revertFunc) { // si changement de position

edit(event);

},
    });
    calendar.render();
  });

  <
  /scrypt>
  @endsection