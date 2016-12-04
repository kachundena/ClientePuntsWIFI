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
        height: 75%;
      }
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/puntswifi.css" rel="stylesheet">
  </head>
<?php
  if (file_exists("config.xml")) {
    $xml = simplexml_load_file("config.xml");
    $str = $xml->asXML();
    $rutaRest = $xml->rutas[0]->rest;
    $rutaBarri = $xml->rutas[0]->barri;
    $rutaDistricte = $xml->rutas[0]->districte;
    $rutaMaps = $xml->rutas[0]->maps;
  }
  else {
      exit('Error al abrir el fichero config.xml');
  }
  if ($rutaDistricte != "") {
    $rutaGetDistrictes = $rutaDistricte."/lista";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $rutaGetDistrictes);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $districtes = json_decode($output, true);
    $arraydistrictes = array();
    $i = 0;
    foreach ($districtes as $key) {
      $arraydistrictes[$i]["id"] =$key['codigo'];
      $arraydistrictes[$i]["deno"] = str_replace("'","`",$key['nombre']);
      $i++;
    }
  }

  if ($rutaBarri != "") {
    if (isset($_POST['cmbdistritos'])) {
      $rutaGetBarris = $rutaBarri."/districte/".$_POST['cmbdistritos'];
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $rutaGetBarris);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $output = curl_exec($ch);
      curl_close($ch);
      $barris = json_decode($output, true);
      $arraybarris = array();
      $i = 0;
      foreach ($barris as $key) {
        $arraybarris[$i]["id"] =$key['barri'];
        $arraybarris[$i]["deno"] = str_replace("'","`",$key['nombre']);
        $i++;
      }
    }
  }


  $ch = curl_init();
  if(isset($_POST['btnDistrito'])) {
    $urlRest = $rutaRest."/distrito/".$_POST['cmbdistritos'];
  }
  else {
    if(isset($_POST['btnBarrio'])) {
      $urlRest = $rutaRest."/barrio/".$_POST['cmbbarrios'];
    }
    else {
      $urlRest = "";
    }
  }
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
    <form role="form" id="frmPuntWifi" method="post" action="maps.php">
      <div class="form-group">
        <label for="sel1">Distritos</label>
        <select class="form-control" name="cmbdistritos" onchange='this.form.submit()'>
<?php
for($i=0; $i<count($arraydistrictes); $i++) {
      //saco el valor de cada elemento
    if ($_POST['cmbdistritos'] == $arraydistrictes[$i]["id"]) {
      $selected = " selected ";
    }
    else {
      $selected = " ";
    }
    echo "<option value='".$arraydistrictes[$i]["id"]."' ".$selected.">".$arraydistrictes[$i]["deno"]."</option>";
    echo "<br>";
}
?>
        </select>
      </div>
      <div class="form-group">
        <label for="sel1">Barrios</label>
        <select class="form-control" name="cmbbarrios">
<?php
for($i=0; $i<count($barris); $i++) {
      //saco el valor de cada elemento
    if ($_POST['cmbbarrios'] == $arraybarris[$i]["id"]) {
      $selected = " selected ";
    }
    else {
      $selected = " ";
    }
    echo "<option value='".$arraybarris[$i]["id"]."' ".$selected.">".$arraybarris[$i]["deno"]."</option>";
    echo "<br>";
}
?>
        </select>
        <button type="submit" name="btnBarrio" class="btn btn-primary">Buscar Puntos Wifi</button>
      </div>
    </form>
    <div id="map"></div>

    <script>

// inicializa el Map en la posición de Barcelona y un zoom que permite verla toda en la pantalla
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: {lat: 41.4, lng: 2.15}
  });
  setMarkers(map);
}

// pasa a variables el array con los puntos wifi seleccionasos
var puntswifi = <?php echo $array; ?>;

function setMarkers(map) {
// declaramos la imagen con el icono que mostrará el punto wifi
  var image = {
    url: 'img/icon.png',
    // This marker is 20 pixels wide by 32 pixels high.
    size: new google.maps.Size(28, 28),
    // The origin for this image is (0, 0).
    origin: new google.maps.Point(0, 0),
    // The anchor for this image is the base of the flagpole at (0, 32).
    anchor: new google.maps.Point(0, 0)
  };

  // definimos la zona de la imagen que se podra hacer click
  var shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
  };

  // marca todos los puntos wifi en el mapa.
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
        src="<?php echo $rutaMaps; ?>">

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
