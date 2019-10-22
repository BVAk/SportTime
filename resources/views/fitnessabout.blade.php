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
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
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
              <div class="white-dots">
                <img src="images/img_2.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    
    <div class="site-section">
      <div class="container">
      
    


        <div class="row">
          @foreach ($trainings as $trainings)
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="news-1" style="background-image:url('images/trainings/{{$trainings->name}}.png')"> 
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
      


    </body>
