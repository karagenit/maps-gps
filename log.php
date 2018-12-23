<?php
  if (!(isset($_GET['lat']) && isset($_GET['lng']))) {
    echo("Incorrect URL Parameters!");
    http_response_code(400);
    die();
  }

  if (($handle = fopen("data.log", "a")) !== FALSE) {
    fwrite($handle, $_GET['lat'] . "," . $_GET['lng'] . "\n");
    fclose($handle);
    echo("Logged Lat: " . $_GET['lat'] . " Lng: " . $_GET['lng']);
  } else {
    echo("Failed to open log file!");
  }
?>
