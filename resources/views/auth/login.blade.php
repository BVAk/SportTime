@extends('layouts.apps')
<div class="ftco-blocks-cover-1">
<div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('images/hero_1.jpg')">
</div> 
</div>
<div class="site-section">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-md-7 mb-5">
            <h5 class="control-label">Login</h5>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="subtitle">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
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
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class= "subtitle"name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                            </div>
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                        </div>
                                <div class="form-group">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
