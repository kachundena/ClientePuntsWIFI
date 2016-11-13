<?php

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Punts WIFI - Barcelona</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 50%;
      }
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/puntswifi.css" rel="stylesheet">
  </head>
<?php
  $ch = curl_init();
  if(isset($_POST['btnDistrito'])) {
    $urlRest = "http://localhost:8084/csvPuntsWifi/api/ws/distrito/".$_POST['cmbdistritos'];
  }
  else {
    if(isset($_POST['btnBarrio'])) {
    $urlRest = "http://localhost:8084/csvPuntsWifi/api/ws/barrio/".$_POST['cmbbarrios'];
    }
    else {
      $urlRest = "";
    }
  }
  echo $urlRest;
  if ($urlRest != "") {
    curl_setopt($ch, CURLOPT_URL, $urlRest);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $puntswifi = json_decode($output, true);
    $array = "[";
    foreach ($puntswifi as $key) {
      if ($array != "[") {
          $array = $array . ",";
      }
      $array = $array . "['" . str_replace("'","`",$key['adreca']) . "'," . $key['latitud'] . "," . $key['longitud']  . "," . $key['linea'] . "]";
    }
    $array = $array . "]";
  }

?>
  <body>
    <form class="form-horizontal" role="form" id="frmPuntWifi" method="post" action="maps.php">
      <div class="form-group">
        <label for="sel1">Distritos</label>
        <select class="form-control" name="cmbdistritos">
          <option value="1">Ciutat Vella</option>
          <option value="2">Eixample</option>
          <option value="3">Sants-Montjuic</option>
          <option value="4">Les Corts</option>
        </select>
        <button type="submit" name="btnDistrito" class="btn btn-primary">Buscar por distrito</button>
      </div>
      <div class="form-group">
        <label for="sel1">Barrios</label>
        <select class="form-control" name="cmbbarrios">
          <option value="1">El Raval</option>
          <option value="2">El Barri Gotic</option>
          <option value="3">La Barceloneta</option>
          <option value="4">Sant Pere, Santa Caterina i la Ribera</option>
        </select>
        <button type="submit" name="btnBarrio" class="btn btn-primary">Buscar por barrio</button>
      </div>
    </form>
    <div id="map"></div>

    <script>

// The following example creates complex markers to indicate beaches near
// Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
// to the base of the flagpole.

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: {lat: 41.4, lng: 2.15}
  });
  setMarkers(map);
}

// Data for the markers consisting of a name, a LatLng and a zIndex for the
// order in which these markers should display on top of each other.
var puntswifi = <?php echo $array; ?>;

function setMarkers(map) {
  // Adds markers to the map.

  // Marker sizes are expressed as a Size of X,Y where the origin of the image
  // (0,0) is located in the top left of the image.

  // Origins, anchor positions and coordinates of the marker increase in the X
  // direction to the right and in the Y direction down.
  var image = {
    url: 'img/icon.png',
    // This marker is 20 pixels wide by 32 pixels high.
    size: new google.maps.Size(28, 28),
    // The origin for this image is (0, 0).
    origin: new google.maps.Point(0, 0),
    // The anchor for this image is the base of the flagpole at (0, 32).
    anchor: new google.maps.Point(0, 0)
  };
  // Shapes define the clickable region of the icon. The type defines an HTML
  // <area> element 'poly' which traces out a polygon as a series of X,Y points.
  // The final coordinate closes the poly by connecting to the first coordinate.
  var shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
  };
  for (var i = 0; i < puntswifi.length; i++) {
    var puntwifi = puntswifi[i];
    var marker = new google.maps.Marker({
      position: {lat: puntwifi[1], lng: puntwifi[2]},
      map: map,
      icon: image,
      shape: shape,
      title: puntwifi[0],
      zIndex: puntwifi[3]
    });
  }
}
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<CLAVE_MAPS>&signed_in=true&callback=initMap">
          
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
