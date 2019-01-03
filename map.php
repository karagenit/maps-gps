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
   $filename = 'data.log';
if (file_exists($filename)) {
    $timestamp = "Last Updated " . date("F d Y H:i:s.", filemtime($filename));
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>CHS Rocket Team Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
	div.a{
			text-align: center;
			
	}
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
  <body onload="startTime()">
  <div class="a">
	<h1 style="font-family:verdana">CHS Rocket Team Location</h1>
	<table style="margin:1em auto;" border="1" cellpadding="10" cellspacing="0">
	<tr>
      <th>Rocket</th>
	  <th>Status</th>
      <th>Latitude</th>
	  <th>Longitude</th>
	  <th>Time</th>
   </tr>
   <tr>
		<td>Rocket #01</td>
		<td><?=$timestamp?></td>
		<td><?=$lat?></td>
		<td><?=$lng?></td>
		<td><div id="txt"></div></td>
	</tr>
	</table>
	</div>
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
	function startTime() {
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();
		m = checkTime(m);
		s = checkTime(s);
		document.getElementById('txt').innerHTML =
		h + ":" + m + ":" + s;
		var t = setTimeout(startTime, 500);
	}
	function checkTime(i) {
		if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		return i;
	}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAteDbXDNBJq6UmK43dtyAdY1pJHXDjS5k<?php file_get_contents?>&callback=initMap"
            async defer></script>
  </body>
</html>
