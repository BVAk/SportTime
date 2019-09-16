@extends('layouts.apps')

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
<img alt="{{Auth::user()->name}}" src="{{Auth::user()->image}}"/>
                </div>
            </div>
        </div>
    </div>
</div>

