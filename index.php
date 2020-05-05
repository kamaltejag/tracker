<?php

  include 'includes/includes.php';

  $initial_result = loadData($conn);
  
  foreach($initial_result as $r){
    $latitude = $r['latitude'];
    $longitude = $r['longitude'];
  }

  $location[0] = $latitude;
  $location[1] = $longitude;

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Leaflet Maps -->
    <link rel="stylesheet" href="leaflet/leaflet.css" />
    <script src="leaflet/leaflet.js"></script>

    <!-- Map Style -->
    <style>
      #map {position: absolute; top: 0rem; right: 0rem; bottom: 0rem; left: 0rem;}
    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Fontawesome Icons -->
    <script src="https://kit.fontawesome.com/996973c893.js"></script>

    <!-- Locate me -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script> -->

    <!-- Slide Marker -->
    <script src='https://unpkg.com/leaflet.marker.slideto@0.2.0/Leaflet.Marker.SlideTo.js'></script>


    <title>Tracker</title>
  </head>
  <body>

    <div id="map" class="map"></div>

    <script>

      var latitude = <?php echo $latitude;?>;
      var longitude = <?php echo $longitude;?>;

      var map = L.map('map').setView([latitude, longitude], 17);
      L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}@2x.png?key=vIUZrAUK7EB68kvLWfvt',{
        tileSize: 512, 
        zoomOffset: -1,
        minZoom: 1,
        maxZoom : 20,
        attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
        crossOrigin: true
      }).addTo(map);
      
      var marker = L.marker([latitude, longitude]).addTo(map);
      marker.bindPopup("<strong>This is the location of the bus</strong>");


      // var lc = L.control.locate({
      //     position: 'topleft',
      //     icon: 'fas fa-map-marker',
      //     showPopup: true,
      //     strings: {
      //       title : "See your current location",
      //       popup : "This is your current location"
      //     },
      //     setView: 'untilPanOrZoom',
      // }).addTo(map);


      setInterval(loadData, 10000);

        function loadData() {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var busLocation = JSON.parse(this.responseText);
              latitude = busLocation[0];
              longitude = busLocation[1];
              marker.slideTo(	[latitude, longitude], {
                duration: 900,
                keepAtCenter: true
              });
              map.setView(new L.LatLng(latitude, longitude), 17);

            }
          };
          xhttp.open("POST", "loadData.php", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send();
        }

    </script>

  </body>
</html>