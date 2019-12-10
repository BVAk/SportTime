<?php

use App\Trainer;

$train_id = Trainer::where('name', '=', Auth::user()->name)->first();

?>
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

    @yield('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

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

                <div class="info"><span class="d-block">Fitness Time</span></div>
            </a>




            <!-- Sidebar Menu -->
            <?php if (Auth::user()->role == 'admin') { ?>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <a href="/admin"> <img src="/images/manager.png" class="img-circle elevation-2" alt="User Image">
                            </a>
                        </div>
                        <div class="info">
                            <a href="/admin" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="/admin" class="nav-link {{request()->path() == 'admin' ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>

                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link {{in_array(request()->path(), ['admin/clients', 'admin/clients/add']) ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Клієнти
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/clients" class="nav-link {{request()->path() == 'admin/clients' ? 'active' : ''}}">
                                            <i class="fas fa-address-card"></i>
                                            <p>Перегляд клієнтів</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/clients/add" class="nav-link {{request()->path() == 'admin/clients/add' ? 'active' : ''}}">
                                            <i class="fas fa-user-plus"></i>
                                            <p>Створити нового клієнта</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            <li class="nav-item has-treeview ">
                                <a href="#" class="nav-link {{in_array(request()->path(), ['admin/trainers', 'admin/trainers/add']) ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Тренери<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/trainers" class="nav-link {{request()->path() == 'admin/trainers' ? 'active' : ''}}">
                                            <i class="fas fa-address-card"></i>
                                            <p>Перегляд тренерів</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/trainers/add" class="nav-link {{request()->path() == 'admin/trainers/add' ? 'active' : ''}}">
                                            <i class="fas fa-user-plus"></i>
                                            <p>Створити нового тренера</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            <li class="nav-item has-treeview ">
                                <a href="#" class="nav-link {{in_array(request()->path(), ['admin/schedule/private', 'admin/schedule/group', 'admin/schedule/child']) ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Розклад<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/schedule/group" class="nav-link {{request()->path() == 'admin/schedule/group' ? 'active' : ''}}">
                                            <i class="fas fa-users"></i>
                                            <p>Группові заняття</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/schedule/private" class="nav-link {{request()->path() == 'admin/schedule/private' ? 'active' : ''}}">
                                            <i class="fas fa-user"></i>
                                            <p>Індивідуальні заняття</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/schedule/child" class="nav-link {{request()->path() == 'admin/schedule/child' ? 'active' : ''}}">
                                            <i class="fas fa-child"></i>
                                            <p>Дитячі заняття</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>



                            <li class="nav-item">
                                <a href="/admin/statistic" class="nav-link {{request()->path() == 'admin/statistic' ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    Статистика
                                </a>

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
                </div>
            <?php } ?>

            <!-- /.sidebar-menu -->
            <!-- Sidebar -->
            <?php if (Auth::user()->role == 'trainer') { ?>
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <a href="/admin/trainers/{{$train_id->id}}"> <img src="/images/manager.png" class="img-circle elevation-2" alt="User Image">
                            </a>
                        </div>
                        <div class="info">
                            <a href="/admin/trainers/{{$train_id->id}}" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                            <li class="nav-item">

                                <a href="/admin/trainers/{{$train_id->id}}" class="nav-link {{request()->path() == 'admin' ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="/admin/clients" class="nav-link {{in_array(request()->path(), ['admin/clients']) ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Клієнти

                                    </p>
                                </a>

                            </li>

                            <li class="nav-item has-treeview ">
                                <a href="#" class="nav-link {{in_array(request()->path(), ['admin/schedule/private', 'admin/schedule/group', 'admin/schedule/child']) ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Розклад<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/schedule/group" class="nav-link {{request()->path() == 'admin/schedule/group' ? 'active' : ''}}">
                                            <i class="fas fa-users"></i>
                                            <p>Группові заняття</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/schedule/private" class="nav-link {{request()->path() == 'admin/schedule/private' ? 'active' : ''}}">
                                            <i class="fas fa-user"></i>
                                            <p>Індивідуальні заняття</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/schedule/child" class="nav-link {{request()->path() == 'admin/schedule/child' ? 'active' : ''}}">
                                            <i class="fas fa-child"></i>
                                            <p>Дитячі заняття</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>



                            <li class="nav-item">
                                <a href="/admin/statistic" class="nav-link {{request()->path() == 'admin/statistic' ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    Статистика
                                </a>

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
                <?php } ?>
                <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
        </aside>


        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content">

                @yield('content')

            </div>
        </div>
    </div>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/js/app.js"></script>

    @yield('script')
</body>

</html>