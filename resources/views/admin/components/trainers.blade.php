@extends('layouts.admin_layout')


@section('content')

    <div class="container-fluid">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $trainers->count() }}</h3>

                    <p>Тренерів</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="/admin/trainers/add" class="small-box-footer"> Зареєструвати тренера<i
                            class="fas fa-arrow-circle-right"></i></a>
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
                            <input type="text" id="myInput" name="table_search" class="form-control float-right"
                                   onkeyup="myFunction()" placeholder="Search">

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
                                <td><a href="editprofile/{{$trainers->id}}">
                                        <button type="button" class="btn btn-warning">Редагувати</button>
                                    </a></td>
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
@endsection

@section('script')
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
@endsection
