@extends('common.default')

@section('content')

@if (Auth::check())
    @if (Auth::user()->isAdmin)
        <!-- Modal -->
        <div class="modal fade" id="addCity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add City</h4>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('cities.store') }}">
                  {{ csrf_field() }}

                  <div class="form-group">
                    <label for="name">name：</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                  </div>

                  <div class="form-group">
                    <label for="email">xaxis：</label>
                    <input type="text" name="xaxis" class="form-control" value="{{ old('xaxis') }}">
                  </div>

                  <div class="form-group">
                    <label for="password">yaxis：</label>
                    <input type="text" name="yaxis" class="form-control" value="{{ old('yaxis') }}">
                  </div>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    @endif
@endif

    <div id="myDiv"></div>

    <script>
        var trace1 = {
          x: @json($xaxis),
          y: @json($yaxis),
          text: @json($citiesName),
          textposition: 'bottom center',
          textfont: {
            family:  'Raleway, sans-serif'
          },
          mode: 'markers+text',
          type: 'scatter',
          marker: { size: 20 }
        };

        // var trace2 = {
        //   x: [1, 3],
        //   y: [10, 13],
        //   type: 'scatter'
        // };

        var data = [trace1];
        var layout = {
            showlegend: false,
            xaxis:{
                    fixedrange: true,
                },
            yaxis:{
                    fixedrange: true
                },
            height: window.innerHeight-70,
            width: window.innerWidth,
        };

        Plotly.newPlot('myDiv', data, layout, {displayModeBar: false});
    </script>
@stop
