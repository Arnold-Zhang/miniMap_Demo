@extends('common.default')

@section('content')

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
          marker: { size: 50 }
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
