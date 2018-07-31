@extends('templates.admins.master')

@section('content')
  <div class="x_panel">
    <div class="row x_title">
      <div class="col-md-6">
        <h3>Per Bulan</h3>
      </div>
      <div class="col-md-6">
        <div class="pull-right dropdown">
          <a id="drop4" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
            Dropdown
            <span class="caret"></span>
          </a>
          <ul id="menu6" class="dropdown-menu animated fadeInDown" role="menu">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="x_content">
      <?php
        $file = Session::get('file');
        $id = Session::get('id');
        $alat = Session::get('alat');
        $i = 0;

        // foreach ($alat as $alats) {
        foreach ($file as $files) {
          $j = 0;
          $k = 0;
          $l = 0;
          $m = 0;
          foreach($alat as $alats) {
            if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
              if($files->id_alat == $alats->id_alat){
                $itung = $files->getAttribute('current_time');
                $gabungThn = $itung[2] * 10 + $itung[3];
                $gabungTgl = $itung[8] * 10 + $itung[9];
                // if($alats->getAttribute('id_alat') == $files->getAttribute('id_alat')){
                if($gabungThn == 18) {
                  if($gabungTgl <= 7) {
                    $j++;
                  }
                  elseif ($gabungTgl <= 14) {
                    $k++;
                  }
                  elseif ($gabungTgl <= 21) {
                    $l++;
                  }
                  elseif ($gabungTgl <= 31) {
                    $m++;
                  }
                  $i++;
                }
              }
            ?>
            <script type="text/javascript">
              var chart1; // globally available
              $(document).ready(function() {
                chart1 = new Highcharts.Chart({
                  chart: {
                    renderTo: 'container<?php echo $alats->id_alat; ?>',
                    type: 'line'
                    },
                    title: {
                    text: '<?php echo $alats->nama_alat; ?>'
                    },
                    xAxis: {
                    categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
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
                    data: [<?php echo $j;?>, <?php echo $k;?>,  <?php echo $l;?>,  <?php echo $m;?>]
                    }]
                });
              });
            </script>
            <!-- fungsi yang di tampilkan dibrowser -->
            <div id="container<?php echo $alats->id_alat; ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      <?php
            }
          }
        }
      ?>
    </div>
  </div>
@endsection
