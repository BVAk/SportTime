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
  <h4>Групові заняття</h4>

  <div id='external-events-list'>
    @foreach($training as $training)
    <div class='fc-event'>{{$training->name}}</div>
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

@section('script')
<script src="{{asset('packages/core/main.js')}}"></script>
<script src="{{asset('packages/interaction/main.js')}}"></script>
<script src="{{asset('packages/daygrid/main.js')}}"></script>
<script src="{{asset('packages/timegrid/main.js')}}"></script>
<script src="{{asset('packages/list/main.js')}}"></script>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script>

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
      plugins: [ 'interaction', 'timeGridWeek', 'timeGrid', 'list' ],
      header: {
        left:'',
        right:'',
        center: 'title',
      },
      minTime: "09:00:00",
      maxTime:"23:00:00",
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar
    eventSources:[ {events: [
      @foreach ($groupschedule as $groupschedule){
      $start={{$groupschedule->start}},
      $end={{$groupschedule->end}},
      $date=new DateTime('now'),
    
      @if($start<$date){
        $start=strtotime("+7 day",strtotime($start)),
        $end=strtotime("+7 day", strtotime($end)),
      }
     @else{
      id:'{{$groupschedule->id}}',
      title  : '{{$groupschedule->name}}',
      start  : '$start',
      end:'$end',
      allDay : false
    }@endif},
    @endforeach
  ],
  color: 'greenyellow',     // an option!
      textColor: 'black' // an option!
    }],
    eventDrop: function(event, delta, revertFunc) { // si changement de position

edit(event);

},
    });
    calendar.render();

  });

  function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'admin/schedule/group',
			 type: "POST",
			 data: {Event:Event},
       success: function(rep) {
					if(rep == 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
</script>

@endsection
