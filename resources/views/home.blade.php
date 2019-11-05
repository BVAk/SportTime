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
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>

            <div class="panel-body">
              @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
              @endif
              <p>My name: {{Auth::user()->name}}</p>
              <p>My Email: {{Auth::user()->email}}</p>


              <div class="mt-4 position-relative">


                <div class="js-yearly-contributions">

                  <div class="position-relative">

                    <div class="border border-gray-dark py-2 graph-before-activity-overview">
                      <div class="js-calendar-graph mx-3 d-flex flex-column flex-items-end flex-xl-items-center overflow-hidden pt-1 is-graph-loading graph-canvas calendar-graph height-full text-center" data-graph-url="/users/andreyromanov/contributions?to=2019-11-05" data-url="/andreyromanov" data-from="2018-11-04 00:00:00 +0200" data-to="2019-11-05 23:59:59 +0200" data-org="">

                        <svg width="828" height="128" class="js-calendar-graph-svg">
                          <g transform="translate(10, 20)" data-hydro-click="{&quot;event_type&quot;:&quot;user_profile.click&quot;,&quot;payload&quot;:{&quot;profile_user_id&quot;:23367130,&quot;target&quot;:&quot;CONTRIBUTION_CALENDAR_SQUARE&quot;,&quot;user_id&quot;:23383350,&quot;client_id&quot;:&quot;1439471101.1564076804&quot;,&quot;originating_request_id&quot;:&quot;65FE:FE94:9064576:D8C11C2:5DC1CDE9&quot;,&quot;originating_url&quot;:&quot;https://github.com/andreyromanov&quot;,&quot;referrer&quot;:&quot;https://github.com/&quot;}}" data-hydro-click-hmac="106e788d8955df89b1abb9df8cd7409a5db9405f904a18c045dcfdb14b9a7826">
                           <?for ($i=0;$i<52;$i+=16){?>
                            <g transform="translate({{$i*16}}, 0)">
                            <?for ($j=0;$j<91;$j+=15){?>
                            <rect class="day" width="12" height="12" x="16-{{$i}}" y="{{$j}}" fill="#239a3b" data-count="2" data-date="2018-11-{{$j}}"/>
                            <?}?>
                            </g>
                            <?} ?>
                            
                            <text x="16" y="-9" class="month">Nov</text>
                            <text x="76" y="-9" class="month">Dec</text>
                            <text x="151" y="-9" class="month">Jan</text>
                            <text x="211" y="-9" class="month">Feb</text>
                            <text x="271" y="-9" class="month">Mar</text>
                            <text x="346" y="-9" class="month">Apr</text>
                            <text x="406" y="-9" class="month">May</text>
                            <text x="466" y="-9" class="month">Jun</text>
                            <text x="541" y="-9" class="month">Jul</text>
                            <text x="601" y="-9" class="month">Aug</text>
                            <text x="661" y="-9" class="month">Sep</text>
                            <text x="736" y="-9" class="month">Oct</text>
                            <text text-anchor="start" class="wday" dx="-10" dy="8" style="display: none;">Sun</text>
                            <text text-anchor="start" class="wday" dx="-10" dy="25">Mon</text>
                            <text text-anchor="start" class="wday" dx="-10" dy="32" style="display: none;">Tue</text>
                            <text text-anchor="start" class="wday" dx="-10" dy="56">Wed</text>
                            <text text-anchor="start" class="wday" dx="-10" dy="57" style="display: none;">Thu</text>
                            <text text-anchor="start" class="wday" dx="-10" dy="85">Fri</text>
                            <text text-anchor="start" class="wday" dx="-10" dy="81" style="display: none;">Sat</text>
                          </g>
                         
                        </svg>

                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>
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


    <script crossorigin="anonymous" integrity="sha512-pLb0KdGv98tBKuIktAXgkkzj5YctsASlAaHp9M28BRo766KtsWiUbAQ9ApBTVhBbJftX2yrrHYAilPdc8JPZ2w==" type="application/javascript" src="https://github.githubassets.com/assets/frameworks-62db07b3.js"></script>
    
    <script crossorigin="anonymous" async="async" integrity="sha512-nITnsRZNziONp9Rn/73yyNlra8L1nPXp13ejdl0hm3Exs0hYsTtfScepr51Ga7I/SQYW7kDTYconHohkEPgtlQ==" type="application/javascript" src="https://github.githubassets.com/assets/github-bootstrap-eafec0d4.js"></script>
    
    
</body>