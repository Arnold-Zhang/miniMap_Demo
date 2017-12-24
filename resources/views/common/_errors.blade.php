@if (count($errors) > 0)
<div class="row">
    <div class="col-md-offset-3 col-md-6">
      <div class="alert alert-danger">
          <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    </div>
  </div>
@endif
