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
    <div class="col-6">
      ФІО клієнта:
    </div>
    <div class="col-6">
      <!-- small box -->
      @foreach ($users as $user)
      {{$user->name}}
      @endforeach
    </div>
  </div>
  <div class="row">
    <div class="col">
      Мобільний номер клієнта:
    </div>
    <div class="col">
      <!-- small box -->

      {{$user->phone}}

    </div>
  </div>
  <div class="row">
    <div class="col">
      Email клієнта:
    </div>
    <div class="col">
      <!-- small box -->

      {{$user->email}}

    </div>
  </div>
  <div class="row">
    <div class="col">
      Діючий абонемент:
    </div>
    <div class="col">
      <!-- small box -->

      {{$user->email}}

    </div>
  </div>

</div>

<div class="container-fluid">
  <div class="row  text-center">
    <form role="form" class="col-6" action="{{ url('/fitness/trainers/privatetrainer') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <h3>Обрати тренера</h3>
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
        <h3>Обрати дату і час тренування</h3>
        <input id="datetrain" name="datetrain" type="datetime-local" class="form-control" value="" required>
      </div>
      <div class="form-group">
        Підтвердити тренування
        <input id="checked" name="checked" type="checkbox" value="1">
      </div>
      <input id="user" name="user" type="hidden" class="form-control" value="{{$user->id }}" required>

      <div class="form-group">
        <input class="btn btn-success center-block btn-lg" type="submit" value="Зареєструвати тренування">
      </div>


    </form>
    <form role="form" class="col-6" action="{{ url('/admin/userabonnement') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <h3>Обрати абонемент</h3>
        <div class="panel panel-default">
          <div class="panel-body" style="width:auto;">

            <select id="selectabonnement" name="abonnement" class="selectpicker" style="font-size: 20px; width:300px;" required>
              <option value=""> ---</option>
              @foreach ($abonnement as $abonnement1)
              <option value="{{$abonnement1->id}}"> {{$abonnement1->name}} - {{$abonnement1->period}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div id="info"></div>
      <input id="user" name="user" type="hidden" class="form-control" value="{{$user->id }}" required>

      <div class="form-group">
        <input class="btn btn-success center-block btn-lg" type="submit" value="Створити абонемент">
      </div>


    </form>

  </div>
  <!-- /.card -->
</div>





<div class="container">
  <div class="row justify-content-center text-center">
    <div id='wrap'>


      <h2>Індивідуальні заняття</h2>

      <div id='external-events-list'>

      </div>

      <form>
        <div id='calendar' ></div>
        <div class="form-group">

        </div>
      </form>
      <div style='clear:both'></div>

    </div>

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

        //// the individual way to do it
        // var containerEl = document.getElementById('external-events-list');
        // var eventEls = Array.prototype.slice.call(
        //   containerEl.querySelectorAll('.fc-event')
        // );
        // eventEls.forEach(function(eventEl) {
        //   new Draggable(eventEl, {
        //     eventData: {
        //       title: eventEl.innerText.trim(),
        //     }
        //   });
        // });

        /* initialize the calendar
        -----------------------------------------------------------------*/

        var calendarEl = document.getElementById('calendar');
        var calendar = new Calendar(calendarEl, {
          plugins: ['interaction', 'timeGridWeek', 'timeGrid', 'list'],
          header: {
            left: '',
            right: '',
            center: 'title',
          },
          minTime: "09:00:00",

          maxTime: "23:00:00",
          editable: false,
          droppable: false, // this allows things to be dropped onto the calendar
          eventSources: [{
            events: [
              @foreach($privateschedule as $privateschedule) {

                id: '{{$privateschedule->privateschedule_id}}',
                title: '{{$privateschedule->trainer_name}}',
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