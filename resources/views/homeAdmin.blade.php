@extends('templates.admins.master')

@section('content')
  <div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-mortar-board"></i></div>
        <div class="count">{{ DB::table('users')->count() }}</div>
        <h3>Anggota</h3>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-globe"></i></div>
        <div class="count">{{ DB::table('cabang')->count() }}</div>
        <h3>Cabang</h3>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-wrench"></i></div>
        <div class="count">{{ DB::table('alat')->count() }}</div>
        <h3>Alat</h3>
      </div>
    </div>
  </div>

  <?php
    $i = 0;
    $cabang = array();
    $output = array();
    $longlat = array();

    foreach ($IP as $IPs) {
      $ping = $IPs->getAttribute('ip_server');
      $name = $IPs->getAttribute('nama_cabang');
      $longitude = $IPs->getAttribute('longitude');
      $latitude = $IPs->getAttribute('latitude');

      $cabang[$i] = shell_exec('ping -n 1 '. $ping);  //kalo ga sekali compiling time nya besar
      $output[$i] = strpos($cabang[$i], 'Reply');

      $longlat[$i] = [$name, (float)$latitude, (float)$longitude];
      $i++;
    }
   ?>

  <head>
    <style>
      #map-canvas {
        width: 1000px;
        height: 500px;
      }
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbJw9v5SiIYxzP5Z3gHHpVwlahVkWapk0&callback=initialize" async defer></script>
    <script type="text/javascript">

    var markers = <?php echo json_encode($longlat); ?>;

      function initialize() {

        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)

        var infowindow = new google.maps.InfoWindow(), marker, i;
        var bounds = new google.maps.LatLngBounds(); // diluar looping
        var daerah = <?php echo json_encode($output);?>;

        for (i = 0; i < markers.length; i++) {
          pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
          bounds.extend(pos); // di dalam looping
          if(daerah[i] > 0){
            marker = new google.maps.Marker({
                position: pos,
                map: map,
                // animation:google.maps.Animation.BOUNCE,
                // icon:'location.png',
              });
            }
            else {
              marker = new google.maps.Marker({
                  position: pos,
                  map: map,
                  // icon:'merah2.png',
              });
            }

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
              infowindow.setContent(markers[i][0]);
              infowindow.open(map, marker);
          }
          })(marker, i));
          map.fitBounds(bounds); // setelah looping
        }

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
    <br>
    <div class="cleafix"></div>
  </body>
@endsection
