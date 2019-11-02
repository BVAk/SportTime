<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Fitness Time</title>

  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">
  <link href="{{ asset('css/jquery.fancybox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  
  
<link href="{{asset('packages/core/main.css')}}" rel="stylesheet"/>
<link href="{{asset('packages/daygrid/main.css')}}" rel="stylesheet" />
<link href="{{asset('packages/timegrid/main.css')}}" rel="stylesheet" />
<link href="{{asset('packages/list/main.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <style>
#wrap {
    width: 1100px;
    margin: 0 auto;
  }
  .text-block {
  position: absolute;
  bottom: 20px;
  right: 20px;
  background-color: black;
  color: white;
  padding-left: 20px;
  padding-right: 20px;
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
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap" id="home-section">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>



    <header class="site-navbar site-navbar-target" role="banner">

      <div class="container mb-3">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto">
            <a href="/">Fitness Time<span class="text-primary">.</span></a>
          </div>
          <div class="site-quick-contact d-none d-lg-flex ml-auto ">
            <div class="d-flex site-info align-items-center mr-5">
              <span class="block-icon mr-3"><span class="icon-map-marker"></span></span>
              <span>Фонтанська дорога 16/8 <br> +38(042)772 7262</span>
            </div>
            <div class="d-flex site-info align-items-center">
              <span class="block-icon mr-3"><span class="icon-clock-o"></span></span>
              <span>пн-пт 9:00-22:00 <br> сб-вс 9:00-21:00</span>
            </div>

          </div>
        </div>
      </div>


      <div class="container">
        <div class="menu-wrap d-flex align-items-center">
          <span class="d-inline-block d-lg-none"><a href="#" class="text-black site-menu-toggle js-menu-toggle py-5"><span class="icon-menu h3 text-black"></span></a></span>


          <nav class="site-navigation text-left mr-auto d-none d-lg-block" role="navigation">
            <ul class="site-menu main-menu js-clone-nav mr-auto ">
              <li><a href="/" class="nav-link">Головна</a></li>
              <li class="active"><a href="/fitness" class="nav-link">Послуги</a></li>
              <li><a href="/price" class="nav-link">Ціни</a></li>

            </ul>
          </nav>

          <div class="top-social ml-auto">
            @guest
            <a href="{{ route('login') }}">Увійти</a>
            <a href="{{ route('register') }}">Зареєструватися</a>
            @else
            <div class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu">
                <li>

                  <a href="{{ route('home') }}">
                    Профіль
                  </a>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Вийти
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </div>
            @endguest
          </div>
        </div>
      </div>
    </header>

    <div class="ftco-blocks-cover-1">
      <div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('images/hero_1.jpg')">
        <div class="container">
          <div class="row align-items-center ">
            <div class="col-md-5 mt-5 pt-5">
              <h1 class="mb-3">Тренування в Fitness Time </ h1>
                              
            </div>
            <div class="col-md-6 ml-auto">
             </div>
          </div>
        </div>
      </div>

    </div>

    <div class="site-section ">
      <div class="container">
      <div class="row justify-content-center text-center">
      <h1 class="mb-3"><b>Індивідуальні заняття </b></h1>
      </div>
        <div class="row">
          @foreach ($trainings as $trainings)
          <div class="col mb-4">
            <div class="news-1" style="background-image:url('images/trainings/{{$trainings->name}}.png')">
            <div class="text-block">
    <h4>{{$trainings->name}}</h4>
  </div>
            
            <div class="text">
                <h3>{{$trainings->name}}</h3>
                <span class="category d-block mb-3">{{$trainings->type}}</span>
                <p class="mb-4">{{$trainings->description}}</p>
                <a href="#" class="d-block arrow-wrap"><span class="icon-arrow_forward"></span></a>
              </div>
            </div>

          </div>
          @endforeach

          
        </div>
         
      </div>
    </div>


    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-7 text-center mb-5">
            <h2 class="section-heading text-center">Кращі тренери</h2>
            <p class="lead">Хочеш привести тіло до порядку, тоді обери кращого наставника</p>
          </div>
        </div>
        <div class="row">
        @foreach($trainergym as $trainergym)
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2 text-center">
              <div class="v-card mb-4 text-center">
                <img src="{{asset($trainergym->image)}}" alt="Image" class="img-fluid mx-auto d-block">
                <span>{{$trainergym->name}}</span>
              </div>
              <blockquote>
                <p>{{date('Y-m-d')-$trainergym->start}} років стажу</p>
              </blockquote> 
            </div>
          </div>
          @endforeach
      </div>
    </div>

    </div>
    <div class="row mt-5">
          <div class="col-lg-12 text-center">
            <a href="fitness/trainers" class="btn btn-primary">Зареєструватися до тренера</a>
          </div>
        </div>
    <div class="site-section">

      <div class="container">
      <div class="row justify-content-center text-center">
      <h1 class="mb-3"><b>Групові заняття </b></h1>
      </div>
        <div class="row">
          @foreach ($trainingsgroup as $trainingsgroup)
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="news-1" style="background-image:url('images/trainings/{{$trainingsgroup->name}}.png')">
            <div class="text-block">
    <h4>{{$trainingsgroup->name}}</h4>
  </div>
            
            <div class="text">
                <h3 style="visibility:visible;">{{$trainingsgroup->name}}</h3>
                <span class="category d-block mb-3">{{$trainingsgroup->type}}</span>
                <p class="mb-4">{{$trainingsgroup->description}}</p>
                <a href="#" class="d-block arrow-wrap"><span class="icon-arrow_forward"></span></a>
              </div>
            </div>

          </div>
          @endforeach

        </div>
      </div>
      <div class="container">  
      <div class="row justify-content-center text-center">
      <h1 class="mb-3"><b>Розклад групових тренувань</b></h1>
      <div id='wrap'> 
  <div id='external-events-list'>
  </div>
<form >
<div id='calendar-group'>
</div>
<div class="form-group"></div>
</form>
<div style='clear:both'></div>
</div>
      </div>
    </div>
</div>


    <div class="site-section section-3" data-stellar-background-ratio="0.5" style="background-image: url('images/hero_2.jpg');">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-7 text-center mb-5">
            <p class="lead text-white">Fitness Time</p>
            <h2 class="text-white">Приведе тебе до форми</h2>
          </div>
        </div>

      </div>
    </div>





<div class="site-section">
      <div class="container">
      <div class="row justify-content-center text-center">
      <h1 class="mb-3"><b>Заняття для дітей</b></h1>
      </div>
        <div class="row">
          @foreach ($trainingschild as $trainingschild)
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="news-1" style="background-image:url('images/trainings/{{$trainingschild->name}}.png')">
            <div class="text-block">
    <h4>{{$trainingschild->name}}</h4>
  </div>
            
            <div class="text">
                <h3 style="visibility:visible;">{{$trainingschild->name}}</h3>
                <span class="category d-block mb-3">{{$trainingschild->type}}</span>
                <p class="mb-4">{{$trainingschild->description}}</p>
                <a href="#" class="d-block arrow-wrap"><span class="icon-arrow_forward"></span></a>
              </div>
            </div>

          </div>
          @endforeach

        </div>
      </div>
      
      <div class="row justify-content-center text-center">
      <div class="container">  
      <h1 class="mb-3"><b>Розклад тренувань для дітей</b></h1>
      <div id='wrap'> 
  <div id='external-events-list'>
  </div>
<form >
<div id='calendar-child'>
</div>
<div class="form-group"></div>
</form>
<div style='clear:both'></div>
</div>
      </div>
    </div>
</div>

  </div>
  
  
  


  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/jquery-migrate-3.0.0.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/jquery.sticky.js') }}"></script>
  <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('js/aos.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{asset('packages/core/main.js')}}"></script>
<script src="{{asset('packages/interaction/main.js')}}"></script>
<script src="{{asset('packages/daygrid/main.js')}}"></script>
<script src="{{asset('packages/timegrid/main.js')}}"></script>
<script src="{{asset('packages/list/main.js')}}"></script>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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

    var calendarEl = document.getElementById('calendar-group');
    var calendar = new Calendar(calendarEl, {
      plugins: [ 'interaction', 'timeGridWeek', 'timeGrid', 'list' ],
      header: {
        left:'',
        right:'',
        center: 'title',
      },
      minTime: "09:00:00",
      defaultDate: '2019-10-06',
      maxTime:"22:00:00",
      editable: false,
      droppable: true, // this allows things to be dropped onto the calendar
    eventSources:[ {events: [
      @foreach ($groupschedule as $groupschedule){
    
      id:'{{$groupschedule->id}}',
      title  : '{{$groupschedule->name}}',
      start  : '{{$groupschedule->start}}',
      end:'{{$groupschedule->end}}',
      allDay : false
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

  color: 'greenyellow',     // an option!
      textColor: 'black' // an option!
    }],
    });
    calendar.render();
  });

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

    var calendarEl = document.getElementById('calendar-child');
    var calendar = new Calendar(calendarEl, {
      plugins: [ 'interaction', 'timeGridWeek', 'timeGrid', 'list' ],
      header: {
        left:'',
        right:'',
        center: 'title',
      },
      minTime: "09:00:00",
      defaultDate: '2019-10-06',
      maxTime:"22:00:00",
      editable: false,
      droppable: true, // this allows things to be dropped onto the calendar
    eventSources:[ {events: [
      @foreach ($childschedule as $childschedule){
    
      id:'{{$childschedule->id}}',
      title  : '{{$childschedule->name}}',
      start  : '{{$childschedule->start}}',
      end:'{{$childschedule->end}}',
      allDay : false
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

  color: 'greenyellow',     // an option!
      textColor: 'black' // an option!
    }],
    });
    calendar.render();
  });
  </script>


</body>