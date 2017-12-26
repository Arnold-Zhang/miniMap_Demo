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

        <div class="modal fade" id="addRoad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add City</h4>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('roads.store') }}">
                  {{ csrf_field() }}

                  <div class="form-group">
                    <label for="name">City A name：</label>
                    <input type="text" name="nameA" class="form-control" value="{{ old('nameA') }}">
                  </div>

                  <div class="form-group">
                    <label for="email">City B name：</label>
                    <input type="text" name="nameB" class="form-control" value="{{ old('nameB') }}">
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
        // 所有城市
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

        // 选取的两个城市
        var trace2 = {
            x: [@json($cityA['xaxis']), @json($cityB['xaxis'])],
            y: [@json($cityA['yaxis']), @json($cityB['yaxis'])],
            type: 'scatter',
            mode: 'markers',
            marker: {
                size: 20,
                color: '#ff0000'
            },
        };
        
        var data = [trace1, trace2];
        var roads = @json($roads);

        var trace;
        for(var v in roads){
            trace = {
                x: roads[v]['xaxis'],
                y: roads[v]['yaxis'],
                type: 'scatter',
                marker: {
                    color: '#000'
                },
            };
            data.push(trace);
        }

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
