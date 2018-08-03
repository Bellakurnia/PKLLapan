@extends('templates.admins.master')

@section('content')
  <div class="x_panel">
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

    <div class="x_content">
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Jan</a></li>
          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Feb</a></li>
          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Mar</a></li>
          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Apr</a></li>
          <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Mei</a></li>
          <li role="presentation" class=""><a href="#tab_content6" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Jun</a></li>
          <li role="presentation" class=""><a href="#tab_content7" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Jul</a></li>
          <li role="presentation" class=""><a href="#tab_content8" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Agu</a></li>
          <li role="presentation" class=""><a href="#tab_content9" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Sep</a></li>
          <li role="presentation" class=""><a href="#tab_content10" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Okt</a></li>
          <li role="presentation" class=""><a href="#tab_content11" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Nov</a></li>
          <li role="presentation" class=""><a href="#tab_content12" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Des</a></li>
        </ul>
        <?php
          $file = Session::get('file');
          $id = Session::get('id');
          $alat = Session::get('alat');
          // dd($alat);
        ?>
        <div id="myTabContent" class="tab-content">

          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
            <?php
              $array = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 1) {
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
                      // dd($k);
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array)) { ?>
                  <div id="container<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array, $alats->id_alat);
                  }
                }
              }
            ?>
          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
            <?php
              $array2 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 2) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containerfeb<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array2)) { ?>
                  <div id="containerfeb<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array2, $alats->id_alat);
                  }
                }
              }
            ?>
          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
            <?php
              $array3 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 3) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containermar<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array3)) { ?>
                  <div id="containermar<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array3, $alats->id_alat);
                  }
                }
              }
            ?>
          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">

            <?php
              $array4 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 4) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containerapr<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array4)) { ?>
                  <div id="containerapr<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array4, $alats->id_alat);
                  }
                }
              }
            ?>

          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">

            <?php
              $array5 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 5) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containermei<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array5)) { ?>
                  <div id="containermei<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array5, $alats->id_alat);
                  }
                }
              }
            ?>

          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab">

            <?php
              $array6 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 6) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containerjun<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array6)) { ?>
                  <div id="containerjun<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array6, $alats->id_alat);
                  }
                }
              }
            ?>

          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab">

            <?php
              $array7 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 7) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containerjul<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array7)) { ?>
                  <div id="containerjul<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array7, $alats->id_alat);
                  }
                }
              }
            ?>

          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="profile-tab">

            <?php
              $array8 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 8) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containeragu<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array8)) { ?>
                  <div id="containeragu<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array8, $alats->id_alat);
                  }
                }
              }
            ?>

          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content9" aria-labelledby="profile-tab">

            <?php
              $array9 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 9) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containersep<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array9)) { ?>
                  <div id="containersep<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array9, $alats->id_alat);
                  }
                }
              }
            ?>

          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content10" aria-labelledby="profile-tab">

            <?php
              $array10 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 10) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containerokt<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array10)) { ?>
                  <div id="containerokt<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array10, $alats->id_alat);
                  }
                }
              }
            ?>

          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content11" aria-labelledby="profile-tab">

            <?php
              $array11 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 11) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containernov<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array11)) { ?>
                  <div id="containernov<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array11, $alats->id_alat);
                  }
                }
              }
            ?>

          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content12" aria-labelledby="profile-tab">

            <?php
              $array12 = array();
              foreach ($alat as $alats) {
                $j = 0;
                $k = 0;
                $l = 0;
                $m = 0;
                foreach ($file as $files) {
                  if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                    $itung = $files->getAttribute('current_time');
                    $gabungThn = $itung[2] * 10 + $itung[3];
                    $gabungBln = $itung[5] * 10 + $itung[6];
                    $gabungTgl = $itung[8] * 10 + $itung[9];
                    if($gabungThn == 18 and $gabungBln == 12) {
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
                    }
                  ?>
                  <script type="text/javascript">
                    var chart1; // globally available
                    $(document).ready(function() {
                      chart1 = new Highcharts.Chart({
                        chart: {
                          renderTo: 'containerdes<?php echo $alats->id_alat; ?>',
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
                          data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                          }]
                      });
                    });
                  </script>
                  <!-- fungsi yang di tampilkan dibrowser -->
                  <?php if(!in_array($alats->id_alat, $array12)) { ?>
                  <div id="containerdes<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                  <?php }
                    array_push($array12, $alats->id_alat);
                  }
                }
              }
            ?>

          </div>

        </div>
      </div>
    </div>

  </div>
@endsection
