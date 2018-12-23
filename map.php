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
      var rocketLocation = {lat: 39.9452131, lng: -86.1492513};
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
