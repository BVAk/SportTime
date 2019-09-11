@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
<img alt="{{Auth::user()->name}}" src="{{Auth::user()->image}}"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
