@foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(session()->has($msg))
  <div class="row">
      <div class="col-md-offset-3 col-md-6">
        <div class="flash-message">
          <p class="alert alert-{{ $msg }}">
            {{ session()->get($msg) }}
          </p>
        </div>
        </div>
    </div>
  @endif
@endforeach
