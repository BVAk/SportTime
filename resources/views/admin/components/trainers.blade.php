
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fitness Time | Администратор</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">
  
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  </head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="app" >

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
   
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- SEARCH FORM -->


    <!-- Right navbar links -->
   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
     
      <div class="info"> <span class="d-block">Fitness Time</span></div>
    </a>
    

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <a href="/admin"> <img src="/images/manager.png" class="img-circle elevation-2" alt="User Image"> </a>
        </div>
        <div class="info">
          <a href="/admin" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
          <a href="/admin" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
</a>
           
          </li>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
              Клієнти
                <i class="fas fa-angle-left right"></i>  
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/clients" class="nav-link ">
                <i class="fas fa-address-card"></i>
                  <p>Перегляд клієнтів</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                <i class="fas fa-user-plus"></i>
                  <p>Створити нового клієнта</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item has-treeview active">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
              Тренери
                <i class="fas fa-angle-left right"></i>  
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/trainers" class="nav-link active">
                <i class="fas fa-address-card"></i>
                  <p>Перегляд тренерів</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                <i class="fas fa-user-plus"></i>
                  <p>Створити нового тренера</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Статистика
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
            </ul>
          </li>

         
          <li class="nav-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                  <i class=" nav-icon fa fa-power-off"></i>
                  <p>Вийти</p>
                </a>
              
              </li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
      
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content">
      <div class="container-fluid">
      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><? echo $trainers->count()?></h3>

                <p>Тренерів</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/admin/trainers/add" class="small-box-footer"> Зареєструвати тренера<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>

          <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">База тренерів</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="myInput" name="table_search" class="form-control float-right" onkeyup="myFunction()" placeholder="Search">

                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="myTable">
                  <thead>
                    <tr>
                      <th>ФІО</th>
                      <th>Стаж роботи</th>
                      <th>Фото</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($trainers as $trainers)
                    <tr>
                      <td> {{$trainers->name}}</td>
                      <td>{{$trainers->start}}</td>
                      <td><img width=100px src="{{asset($trainers->image)}}"/></td>
                      <td><a href="editprofile/{{$trainers->id}}"><button type="button" class="btn btn-warning">Редагувати</button></a></td>
                     </tr>
                     @endforeach
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
   
      </div>
    </div>
</div>

  <footer class="main-footer">
  &copy; Copyright Fitness Time 2019. Developed and designed by Bekk
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
<script src="/js/app.js"></script>
</body>
</html>
