@extends('layouts.app')

@section('content')
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
  <div class="card-box">
    <div class="panel-heading">
      <h3 class="text-center"> Sign Up for <img class="img" src="/images/doohpress_orange_web-horiz.png"> </h3>
    </div>

    <div class="p-20">
      <form class="form-horizontal m-t-20" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <span class="badge badge-success">1</span><strong> Create your team</strong> <i class="fa fa-question-circle-o"data-toggle="tooltip" data-placement="right" title="" data-original-title="Creating a team means you can invite more people to your account later!"></i>
        <div class="form-group{{ $errors->has('teamname') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input id="name" type="text" class="form-control" placeholder="Team name" name="teamname" value="{{ old('firstname') }}" required autofocus>

                @if ($errors->has('teamname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('teamname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <hr />


        <span class="badge badge-success">2</span><strong> Enter your details</strong>
        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input id="name" type="text" class="form-control" placeholder="Firstname" name="firstname" value="{{ old('firstname') }}" required autofocus>

                @if ($errors->has('firstname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
          <div class="col-md-12">
                <input id="name" type="text" class="form-control" placeholder="Lastname" name="lastname" value="{{ old('lastname') }}" required autofocus>

                @if ($errors->has('lastname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group">
          <div class="col-12">
            @if ($errors->has('accept_terms'))
                <span class="help-block">
                    <strong>{{ $errors->first('accept_terms') }}</strong>
                </span>
            @endif
            <div class="checkbox checkbox-primary">
              <input id="checkbox-signup" name="accept_terms" type="checkbox">
              <label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
            </div>
          </div>
        </div>

        <div class="form-group text-center m-t-40">
          <div class="col-12">
            <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light" type="submit">
              Register
            </button>
          </div>
        </div>

      </form>

    </div>
  </div>

  <div class="row">

    <div class="col-12 text-center">
      <div class="card-box">
      <p>
        Already have account?<a href="/login" class="text-primary m-l-5"><b>Sign In</b></a>
      </p>
    </div>
  </div>
  </div>

</div>
@endsection
