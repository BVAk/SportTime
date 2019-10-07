@extends('layouts.admin_layout')

@section('style')
  <style>
    .paginate-btn {
      text-decoration: none;
      display: inline-block;
      padding: 8px 16px;
      cursor: pointer;
    }
    .paginate-div {
      margin: 30px 0;
      text-align: center;
    }

    .paginate-btn:hover {
      background-color: #ddd;
      color: black;
    }

    .previous {
      background-color: #4CAF50;
      color: white;
    }

    .next {
      background-color: #4CAF50;
      color: white;
    }

    .disabled {
      background-color: #f1f1f1;
      color: black;
      cursor: not-allowed;
    }

    .round {
      border-radius: 50%;
    }
  </style>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="col-lg-3 col-6">
            <!-- small box -->


            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{\App\User::count()}}</h3>
                    <p>Зареєстрованих користувачів</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="/admin/clients/add" class="small-box-footer">Зареєструвати клієнта <i
                            class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">База клієнтів</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input  type="text" id="search" name="table_search" class="form-control float-right"
                                   onkeydown = "if (event.keyCode == 13) filterData('search')" placeholder="Search">

                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover" id="myTable">
                        <thead>
                        <tr>
                            <th>ФІО</th>
                            <th>Пошта</th>
                            <th>Мобільний зв'язок</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td> {{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td><a href="editprofile/{{$user->id}}">
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
          <div class="paginate-div">
            <a tabindex="" class="paginate-btn previous round {{request()->page <= 1 ? 'disabled' : ''}}"  @if(request()->page <= 1) disabled @else onclick="filterData(-1)" @endif>&#8249;</a>
            <a tabindex="" class="paginate-btn next round {{request()->page >= $users->lastPage() ? 'disabled' : ''}}" @if(request()->page >= $users->lastPage()) disabled @else onclick="filterData(1)" @endif>&#8250;</a>
          </div>
        </div>
    </div>

@endsection

@section('script')
  <script>

    const path = '/{{request()->path()}}'; // the current url
    let page = parseInt('{{request()->page}}')  || 1; // the current page
    let search = ''; // search request

    /**
    * Search or get the new page
    *
    * @param mode
    * @return void
    */
    function filterData(mode) {
      search = document.getElementById('search').value;
      if(mode != 'search') page += mode;
      else page = 1;

      window.location.href = path + '?page=' + page + (search ? ('&search=' + search) : '');
    }

  </script>
@endsection
