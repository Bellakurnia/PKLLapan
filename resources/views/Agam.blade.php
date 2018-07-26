@extends('templates.admins.master')

@section('content')
  <script type="text/javascript">
    var chart1; // globally available
    $(document).ready(function() {
      chart1 = new Highcharts.Chart({
        chart: {
          renderTo: 'container',
          type: 'line'
        },
          title: {
          text: 'Nama Alat'
          },
          xAxis: {
          categories: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4']
          },
          yAxis: {
          title: {
            text: 'Data'
          }
          },
          plotOptions: {
          line: {
            dataLabels: {
            enabled: true
            },
            enableMouseTracking: false
          }
          },
          series: [{

          name: 'Jumlah Data',
          data: [1, 2, 3, 2]
          }]
                });
              });
  </script>
  <!-- fungsi yang di tampilkan dibrowser  -->
  <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
@endsection
