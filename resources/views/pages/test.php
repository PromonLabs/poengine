@extends('layouts.app')

@section('content')

@if (!empty($result))
  @foreach ($result as $resultdata)
  <? $dt= array(); ?>
    @foreach ($resultdata->values as $vals)
    <? $i = 1; $dt= array(); ?>
        @foreach ($vals as $val)
            <? if($i % 2 == 0){
                $val = (float)$val;
            } else {
                $val = $val.'000';
            }
            $dt= (float)str_replace(".", "", $val); 
            $i++; ?>
        @endforeach
        {{ dd($dt)}}
    @endforeach
  <? $data[] =$dt; ?>
  @endforeach
@endif
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <button type="submit" class="btn btn-default" onclick="showGraph({{json_encode($data)}})">Show Graph</button>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
  <!-- /.content-wrapper -->
@endsection
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('assets/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('assets/highcharts/modules/exporting.js') }}"></script>
<script src="{{ asset('assets/highcharts/modules/export-data.js') }}"></script>
<script type="text/javascript">
  function showGraph(data) {
    console.log(data); alert(data);
      Highcharts.chart('container', {
          chart: {
              zoomType: 'x'
          },
          title: {
              text: 'Counts'
          },
          subtitle: {
              text: document.ontouchstart === undefined ?
                  'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
          },
          xAxis: {
              type: 'datetime'
          },
          yAxis: {
            title: {
                      text: 'Counts'
                  }
          },
          legend: {
              enabled: false
          },
          plotOptions: {
              
          },

          series: [{
              type: 'area',
              name: 'Count',
              data: data
              //data:[1531899717.37, 1]
              //data:[1531904661.757,6,1531904661.757,10,1531904661.757,9,1531904661.757,28577,1531904661.757,222,1531904661.757,62,1531904661.757,73]
              //data:[1531904661757,6,1531904661757,10,1531904661757,9,1531904661.757,28577,1531904661.757,222,1531904661.757,62,1531904661.757,73]
              //data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
          }]
      });
  }
</script>