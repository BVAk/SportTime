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
    <div class="row">
        <div class="col-12">
        <div id='wrap'>

<div id='external-events'>
  <h4>Draggable Events</h4>

  <div id='external-events-list'>
    @foreach($training as $training)
    <div class='fc-event'>{{$training->name}}</div>
    @endforeach
  </div>

  <p>
    <input type='checkbox' id='drop-remove' />
    <label for='drop-remove'>remove after drop</label>
  </p>
</div>

<div id='calendar'></div>

<div style='clear:both'></div>

</div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection

@section('script')
<script src="{{asset('packages/core/main.js')}}"></script>
<script src="{{asset('packages/interaction/main.js')}}"></script>
<script src="{{asset('packages/daygrid/main.js')}}"></script>
<script src="{{asset('packages/timegrid/main.js')}}"></script>
<script src="{{asset('packages/list/main.js')}}"></script>
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
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar
      drop: function(arg) {
        // is the "remove after drop" checkbox checked?
        if (document.getElementById('drop-remove').checked) {
          // if so, remove the element from the "Draggable Events" list
          arg.draggedEl.parentNode.removeChild(arg.draggedEl);
        }
      }
    });
    calendar.render();

  });

</script>

@endsection
