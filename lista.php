<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="./js/jquery-1.11.3.min.js"></script>



    <title>Lista de puntos WIFI - Barcelona</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/puntswifi.css" rel="stylesheet">

  </head>


  <body>
<?php
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://localhost:8084/csvPuntsWifi/api/ws/lista");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $output = curl_exec($ch);
  curl_close($ch);

?>

  <div class="container">
  <div class="page-header">
    <h1>Lista de puntos WIFI</h1>
  </div>
  <div class="container">
    <button type="button" name="btnNuevo" class="btn btn-primary" onclick="window.location.href='puntwifi.php?acc=N'">Nuevo Punto Wifi</button>
  </div>
  <br/>
<?php
  //$jsonIterator = new RecursiveIteratorIterator(
  //    new RecursiveArrayIterator(json_decode($output, TRUE)),
  //    RecursiveIteratorIterator::SELF_FIRST);
?>
    <table class="table table-bordered table-striped ">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Distrito</th>
            <th>Barrio</th>
            <th>Direccion</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    $puntswifi = json_decode($output, true);
    foreach ($puntswifi as $key) {
?>
        <tr>
          <?php
            echo "<td><a href='puntwifi.php?acc=M&lin=".$key['linea']."'><img src='img/flecha.gif'></td>";
            echo "<td>".$key['nom_DISTRICTE']."</td>";
            echo "<td>".$key['nom_BARRI']."</td>";
            echo "<td>".$key['adreca']."</td>";
            echo "<td><a href='puntwifi.php?acc=D&lin=".$key['linea']."'><img src='img/borrar.png'></td>";
          ?>
        </tr>
 <?php
    }
?>
    </tbody>
</table>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
