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

  <link crossorigin="anonymous" media="all" integrity="sha512-/YEVWs7BzxfKyUd6zVxjEQcXRWsLbcEjv045Rq8DSoipySmQblhVKxlXLva2GtNd5DhwCxHwW1RM0N9I7S2Vew==" rel="stylesheet" href="https://github.githubassets.com/assets/frameworks-481a47a96965f6706fb41bae0d14b09a.css" />
  <link crossorigin="anonymous" media="all" integrity="sha512-8yRKCmpBPsIyuLQNxQmP0kBfYdvNOz5EkCagWypV27znz6gRd0tHzdbCb2P/9XXEQcXFRMXC2olX8bhjTjbTYA==" rel="stylesheet" href="https://github.githubassets.com/assets/github-d12aa61f11c1ece71b4c19b1ba4dac4a.css" />

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
              <li class="active"><a href="/" class="nav-link">Головна</a></li>
              <li><a href="/fitness" class="nav-link">Послуги</a></li>
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
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        


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
      @foreach ($userabonnement as $userabonnement)
      <div class="row">
      {{$userabonnement->name}}
     <?if ($userabonnement->amount==NULL){?>
      до {{$userabonnement->end}}
     <? }else {?> {{$userabonnement->amount}} тренувань(ння) <?}?>
     </div>
     @endforeach
    </div>
  </div>

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


    <script crossorigin="anonymous" integrity="sha512-pLb0KdGv98tBKuIktAXgkkzj5YctsASlAaHp9M28BRo766KtsWiUbAQ9ApBTVhBbJftX2yrrHYAilPdc8JPZ2w==" type="application/javascript" src="https://github.githubassets.com/assets/frameworks-62db07b3.js"></script>
    
    <script crossorigin="anonymous" async="async" integrity="sha512-nITnsRZNziONp9Rn/73yyNlra8L1nPXp13ejdl0hm3Exs0hYsTtfScepr51Ga7I/SQYW7kDTYconHohkEPgtlQ==" type="application/javascript" src="https://github.githubassets.com/assets/github-bootstrap-eafec0d4.js"></script>
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

    
</body>