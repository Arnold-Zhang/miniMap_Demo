@extends('common.default')
@section('title', 'Sign In')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h5>Sign In</h5>
            </div>
            <div class="panel-body">
              @include('common._errors')

              <form method="POST" action="{{ route('signIn') }}">
                  {{ csrf_field() }}

                  <div class="form-group">
                    <label for="email">email：</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                  </div>

                  <div class="form-group">
                    <label for="password">password：</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                  </div>

                  <div class="checkbox">
                    <label><input type="checkbox" name="remember"> remember me</label>
                  </div>

                  <button type="submit" class="btn btn-primary">Sign In</button>
              </form>

              <hr>

              <p>Don't have an account ? <a href="{{ route('signup') }}">Sign Up Now！</a></p>
            </div>
          </div>
        </div>
    </div>
</div>
@stop
