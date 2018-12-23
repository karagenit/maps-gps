<?php
  $lat = 0;
  $lng = 0;
  if (($handle = fopen("data.log", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      if (count($data) == 2) {
        $lat = $data[0];
        $lng = $data[1];
      }
    }
    fclose($handle);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var rocketLocation = {lat: <?=$lat?>, lng: <?=$lng?> };
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: rocketLocation,
          zoom: 17 
        });
        var marker = new google.maps.Marker({position: rocketLocation, map: map});
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php file_get_contents('api.key') ?>&callback=initMap"
            async defer></script>
  </body>
</html>
