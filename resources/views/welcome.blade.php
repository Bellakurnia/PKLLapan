<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" href="favicon.ico">
      <title>siapLapan</title>

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

      <!-- Styles -->
      <style>
          html, body {
              background-color: #fff;
              color: #636b6f;
              font-family: 'Raleway', sans-serif;
              font-weight: 100;
              height: 100vh;
              margin: 0;
          }

          .full-height {
              height: 100vh;
          }

          .flex-center {
              align-items: center;
              display: flex;
              justify-content: center;
          }

          .position-ref {
              position: relative;
          }

          .top-right {
              position: absolute;
              right: 10px;
              top: 18px;
          }

          .content {
              text-align: center;
          }

          .title {
              font-size: 84px;
          }

          .links > a {
              color: #636b6f;
              padding: 0 25px;
              font-size: 12px;
              font-weight: 600;
              letter-spacing: .1rem;
              text-decoration: none;
              text-transform: uppercase;
          }

          .m-b-md {
              margin-bottom: 30px;
          }
      </style>

      <?php
        $cabang1 = shell_exec('ping -n 1 google.com');
        $output1 = strpos($cabang1, 'Pinging');

        $cabang2 = shell_exec('ping -n 1 google.com');
        $output2 = strpos($cabang2, 'Pinging');

        $cabang3 = shell_exec('ping -n 1 adamfir.id');
        $output3 = strpos($cabang3, 'Pinging');

        $cabang4 = shell_exec('ping -n 1 adamfir.id');
        $output4 = strpos($cabang4, 'Pinging');

        $cabang5 = shell_exec('ping -n 1 adamfir.id');
        $output5 = strpos($cabang5, 'Pinging');

        $cabang6 = shell_exec('ping -n 1 adamfir.id');
        $output6 = strpos($cabang6, 'Pinging');

        $cabang7 = shell_exec('ping -n 1 adamfir.id');
        $output7 = strpos($cabang7, 'Pinging');

        $cabang8 = shell_exec('ping -n 1 adamfir.id');
        $output8 = strpos($cabang8, 'Pinging');

        $cabang9 = shell_exec('ping -n 1 adamfir.id');
        $output9 = strpos($cabang9, 'Pinging');

        $cabang10 = shell_exec('ping -n 1 google.com');
        $output10 = strpos($cabang10, 'Pinging');

        $my_array = array($output1, $output2, $output3, $output4, $output5, $output6, $output7, $output8, $output9, $output10);
      ?>

      <style>
        #map-canvas {
          width: 1000px;
          height: 500px;
        }
      </style>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbJw9v5SiIYxzP5Z3gHHpVwlahVkWapk0&callback=initialize" async defer></script>
      <script type="text/javascript">
      function getdata(valarray){
        var valarray = <?php echo json_encode($my_array); ?>;
        console.log('we got: '+ valarray);
      }
      var markers = [
        ['LAPAN Pusat', -6.893376 , 107.591779],
        ['LAPAN Pontianak', -0.003658, 109.366238],
        ['LAPAN Biak', -1.174, 136.10077],
        ['LAPAN Garut', -7.650007, 107.6921543],
        ['LAPAN Tanjung Sari', -6.9130788, 107.8372133],
        ['LAPAN Manado', 1.4554793, 124.8272348],
        ['LAPAN Kupang', -10.1544464, 123.6589219],
        ['LAPAN Agam', -0.2044474, 100.3200362],
        ['LAPAN Pasuruan', -7.567506, 112.6758962],
        ['LAPAN Yogyakarta', -7.7822387, 110.4435957],
      ];

        function initialize() {

          var mapCanvas = document.getElementById('map-canvas');
          var mapOptions = {
            mapTypeId: google.maps.MapTypeId.ROADMAP
          }
          var map = new google.maps.Map(mapCanvas, mapOptions)

          var infowindow = new google.maps.InfoWindow(), marker, i;
          var bounds = new google.maps.LatLngBounds(); // diluar looping
          var daerah = <?php echo json_encode($my_array); ?>;

          for (i = 0; i < markers.length; i++) {
            pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(pos); // di dalam looping
            if(daerah[i] == 1){
              marker = new google.maps.Marker({
                  position: pos,
                  map: map,
                  // animation:google.maps.Animation.BOUNCE,
                  icon:'biru2.png',
                });
              }
              else {
                marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    // animation:google.maps.Animation.BOUNCE,
                    icon:'merah2.png',
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
    <!-- <link rel="shortcut icon" href="favicon.ico" type="image/ico"> -->
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
          <div class="top-right links">
            @auth
              <a href="{{ url('/home') }}">Home</a>
            @else
              <a href="{{ route('login') }}">Login</a>
              <!-- <a href="{{ route('register') }}">Register</a> -->
            @endauth
          </div>
        @endif

        <!-- <div class="content">
            <div class="title m-b-md">
                Laravel
            </div>

            <div class="links">
                <a href="https://laravel.com/docs">Documentation</a>
                <a href="https://laracasts.com">Laracasts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div> -->

          <div id="map-canvas"></div>
          <br>
          <div class="cleafix"></div>

    </div>
  </body>
</html>
