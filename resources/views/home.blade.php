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
          <div class="site-section bg-light">
            <div class="container">
              <div class="row justify-content-center text-center">
                <div class="col-7 text-center mb-5">
                  <h2 class="section-heading text-center"> @foreach ($users as $user)
                    {{$user->name}}
                    @endforeach</h2>
                  <p class="lead">

                    <span> ФІО клієнта: {{$user->name}}</span><br>
                    <span> Мобільний номер клієнта: {{$user->phone}}</span><br>
                    <span>Email клієнта: {{$user->email}}</span><br>
                    <span>Стан здоров'я:{{$user->health}}</span></p><br>
                </div>
              </div>



              <div class="row justify-content-center text-center">
                <div class="col-lg-6 mb-6 mb-lg-0">
                  <div class="testimonial-2 text-center">
                    <div class="v-card mb-6 text-center">

                      <span>Діючий абонемент:</span>
                    </div>
                    <blockquote>
                      @foreach ($userabonnement as $userabonnement1)
                      <? if ($userabonnement1->end > new \Date('now') or ($userabonnement1->amount != 0)) { ?>


                        {{$userabonnement1->name}}<br>
                        <? if ($userabonnement1->amount == 0) { ?>
                          до {{$userabonnement1->end}}
                        <? } else { ?> {{$userabonnement1->amount}} тренувань(ння) <? } ?>



                      <? } ?>
                      <br>
                      @endforeach
                    </blockquote>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>



      </div>




      <div class="site-section section-3" data-stellar-background-ratio="0.5" style="background-image: url('/images/hero_2.jpg');">

        <div class="container">
          <div class="row justify-content-center text-center">

            @if(!empty($quality))
            @else
            <form role="form" class="col-md-6 col-lg-4 mb-4 go-right" action="{{ url('/quality') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="form-group">
                  <h2 class="text-white">Допоможіть оцінити якість роботи фітнес клуба</h2>
                  <div class="form-group">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                  </div>
                  <div class="form-group">
                    <h4 class="text-white"> Оцініть просторову доступність фітнес клуба від 0 до 10, де 0-найнижча оцінка</h4>
                    <input type="range" name="place" min="0" max="10" step="1" onchange="document.getElementById('rangeValue').innerHTML = this.value;" list="rangeList"> <span id="rangeValue" class="text-white">5</span>
                  </div>
                  <div class="form-group">
                    <h4 class="text-white"> Оцініть організаційну доступність фітнес клуба від 0 до 10, де 0-найнижча оцінка</h4>
                    <input type="range" name="organization" min="0" max="10" step="1" onchange="document.getElementById('rangeValue2').innerHTML = this.value;" list="rangeList"> <span id="rangeValue2" class="text-white">5</span>
                  </div>
                  <div class="form-group">
                    <h4 class="text-white"> Оцініть вартісну доступність фітнес клуба від 0 до 10, де 0-найнижча оцінка</h4>
                    <input type="range" name="cost" min="0" max="10" step="1" onchange="document.getElementById('rangeValue3').innerHTML = this.value;" list="rangeList"> <span id="rangeValue3" class="text-white">5</span>
                  </div>
                  <div class="form-group">
                    <h4 class="text-white"> Оцініть асортимент послуг від 0 до 10, де 0-найнижча оцінка</h4>
                    <input type="range" name="assortment" min="0" max="10" step="1" onchange="document.getElementById('rangeValue4').innerHTML = this.value;" list="rangeList"> <span id="rangeValue4" class="text-white">5</span>
                  </div>
                  <div class="form-group">
                    <h4 class="text-white"> Оцініть гігєну фітнес клуба від 0 до 10, де 0-найнижча оцінка</h4>
                    <input type="range" name="hygiene" min="0" max="10" step="1" onchange="document.getElementById('rangeValue5').innerHTML = this.value;" list="rangeList"> <span id="rangeValue5" class="text-white">5</span>
                  </div>
                  <div class="form-group">
                    <h4 class="text-white"> Оцініть матеріально-технічне оснащення фітнес клуба від 0 до 10, де 0-найнижча оцінка</h4>
                    <input type="range" name="material" min="0" max="10" step="1" onchange="document.getElementById('rangeValue6').innerHTML = this.value;" list="rangeList"> <span id="rangeValue6" class="text-white">5</span>
                  </div>
                  <div class="form-group">
                    <h4 class="text-white"> Оцініть якість проведення тренувань від 0 до 10, де 0-найнижча оцінка</h4>
                    <input type="range" name="quality_lesson" min="0" max="10" step="1" onchange="document.getElementById('rangeValue7').innerHTML = this.value;" list="rangeList"> <span id="rangeValue7" class="text-white">5</span>
                  </div>
                </div>
                <datalist id="rangeList">
                  <option value="0" label="0">
                  <option value="1" label="1">
                  <option value="2" label="2">
                  <option value="3" label="3">
                  <option value="4" label="4">
                  <option value="5" label="5">
                  <option value="6" label="6">
                  <option value="7" label="7">
                  <option value="8" label="8">
                  <option value="9" label="9">
                  <option value="10" label="10">
                </datalist>
                <input class="btn btn-success center-block btn-lg" type="submit" value="Відправити дані">
            </form> @endif </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row justify-content-center text-center">
        <div id='wrap'>


          <h2>Індивідуальні заняття</h2>

          <div id='external-events-list'>

          </div>
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



        },
      });
      calendar.render();

    });
  </script>


</body>