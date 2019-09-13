@extends('layouts.apps')

<div class="ftco-blocks-cover-1">
<div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('images/hero_1.jpg')">
</div>
</div>
<div class="site-section">
<div class="container">
<div class="row justify-content-center text-center">
    <div class="col-md-7 mb-5">
        <div class="panel panel-default">
            <h5 class="control-label">Register</h5>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="subtitle">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="subtitle">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="subtitle">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="subtitle">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                        </div>
                    </form>
                    <form>
</form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>