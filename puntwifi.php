<?php
 class puntwifi {

   var $linea;
   var $codi_CAPA;
   var $capa_GENERICA;
   var $nom_CAPA;
   var $ed50_COORD_X;
   var $ed50_COORD_Y;
   var $etrs89_COORD_X;
   var $etrs89_COORD_Y;
   var $longitud;
   var $latitud;
   var $equipament;
   var $districte;
   var $barri;
   var $nom_DISTRICTE;
   var $nom_BARRI;
   var $adreca;
   var $telefon;


   function puntwifi($linea, $codi_CAPA, $capa_GENERICA, $nom_CAPA, $ed50_COORD_X, $ed50_COORD_Y, $etrs89_COORD_X, $etrs89_COORD_Y,
   $longitud, $latitud, $equipament, $districte, $barri, $nom_DISTRICTE, $nom_BARRI, $adreca, $telefon) {
     $this->linea = $linea;
     $this->codi_CAPA = $codi_CAPA;
     $this->capa_GENERICA = $capa_GENERICA;
     $this->nom_CAPA = $nom_CAPA;
     $this->ed50_COORD_X = $ed50_COORD_X;
     $this->ed50_COORD_Y = $ed50_COORD_Y;
     $this->etrs89_COORD_X = $etrs89_COORD_X;
     $this->etrs89_COORD_Y = $etrs89_COORD_Y;
     $this->longitud = $longitud;
     $this->latitud = $latitud;
     $this->equipament = $equipament;
     $this->districte = $districte;
     $this->barri = $barri;
     $this->nom_DISTRICTE = $nom_DISTRICTE;
     $this->nom_BARRI = $nom_BARRI;
     $this->adreca = $adreca;
     $this->telefon = $telefon;
   }

 }

  if($_POST) {
    if(isset($_POST['btnAceptar'])) {
      $acc = $_POST['hdacc'];
      $lin = $_POST['hdlin'];
      $output = true;
      $message = "";
      if ($acc == 'N') {
        $codi_CAPA = $_POST['txtcodicapa'];
        $capa_GENERICA = $_POST['txtcapagenerica'];
        $nom_CAPA = $_POST['txtnomcapa'];
        $ed50_COORD_X = (float) $_POST['txted50coordx'];
        $ed50_COORD_Y = (float) $_POST['txted50coordy'];
        $etrs89_COORD_X = (float) $_POST['txtetrs89coordx'];
        $etrs89_COORD_Y = (float) $_POST['txtetrs89coordy'];
        $longitud = (float) $_POST['txtlongitud'];
        $latitud = (float) $_POST['txtlatitud'];
        $equipament = $_POST['txtequipament'];
        $districte = (int) $_POST['txtdistricte'];
        $barri = (int) $_POST['txtbarri'];
        $nom_DISTRICTE = $_POST['txtnomdistricte'];
        $nom_BARRI = $_POST['txtnombarri'];
        $adreca = $_POST['txtadreca'];
        $telefon = $_POST['txttelefon'];
        $vPuntWifi = new puntwifi($lin, $codi_CAPA, $capa_GENERICA, $nom_CAPA, $ed50_COORD_X, $ed50_COORD_Y, $etrs89_COORD_X, $etrs89_COORD_Y,
        $longitud, $latitud, $equipament, $districte, $barri, $nom_DISTRICTE, $nom_BARRI, $adreca, $telefon);
        $json = json_encode($vPuntWifi);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8084/csvPuntsWifi/api/ws/add");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','authorization: tr12fi34ma56'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
            if ($output == "false") {
            	$message = "No se ha podido crear el punto wifi";
            }
        curl_close($ch);
      }
      else {
        if ($acc == 'M') {
          $codi_CAPA = $_POST['txtcodicapa'];
          $capa_GENERICA = $_POST['txtcapagenerica'];
          $nom_CAPA = $_POST['txtnomcapa'];
          $ed50_COORD_X = (float) $_POST['txted50coordx'];
          $ed50_COORD_Y = (float) $_POST['txted50coordy'];
          $etrs89_COORD_X = (float) $_POST['txtetrs89coordx'];
          $etrs89_COORD_Y = (float) $_POST['txtetrs89coordy'];
          $longitud = (float) $_POST['txtlongitud'];
          $latitud = (float) $_POST['txtlatitud'];
          $equipament = $_POST['txtequipament'];
          $districte = (int) $_POST['txtdistricte'];
          $barri = (int) $_POST['txtbarri'];
          $nom_DISTRICTE = $_POST['txtnomdistricte'];
          $nom_BARRI = $_POST['txtnombarri'];
          $adreca = $_POST['txtadreca'];
          $telefon = $_POST['txttelefon'];
          $vPuntWifi = new puntwifi($lin, $codi_CAPA, $capa_GENERICA, $nom_CAPA, $ed50_COORD_X, $ed50_COORD_Y, $etrs89_COORD_X, $etrs89_COORD_Y, $longitud, $latitud, $equipament, $districte, $barri, $nom_DISTRICTE, $nom_BARRI, $adreca, $telefon);
          $json = json_encode($vPuntWifi);
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "http://localhost:8084/csvPuntsWifi/api/ws/update");
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($json),'authorization: tr12fi34ma56'));
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
          curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          $output = curl_exec($ch);
			if ($output == "false") {
				$message = "No se ha podido guardar el punto wifi";
			}
          curl_close($ch);
        }
        else {
          if ($acc == 'D') {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:8084/csvPuntsWifi/api/ws/delete/".$lin);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('authorization: tr12fi34ma56'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            //curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            if ($output == "false") {
            	$message = "No se ha podido eliminar el punto wifi";
            }
            curl_close($ch);
          }

        }
      }
    }
    else {
    }
    if ($output == "false") {
		echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else {
		header("Location: lista.php");
		die();
	}

  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="./js/jquery-1.11.3.min.js"></script>



    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Punts WIFI Barcelona - Edición</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
<?php
	if (!isset($acc)&&!isset($lin)) {
	  $acc = $_GET['acc'];
	  $lin = $_GET['lin'];
	}
  if ($acc == 'N') // Nuevo
  {
    $linea = 0;
    $codi_CAPA = '';
    $capa_GENERICA = '';
    $nom_CAPA = '';
    $ed50_COORD_X = '';
    $ed50_COORD_Y = '';
    $etrs89_COORD_X = '';
    $etrs89_COORD_Y = '';
    $longitud = '';
    $latitud = '';
    $equipament = '';
    $districte = '';
    $barri = '';
    $nom_DISTRICTE = '';
    $nom_BARRI = '';
    $adreca = '';
    $telefon = '';
    $titulo = 'Nuevo Punto WIFI';
    $estilo = '';
  }
  else // Modificación y Borrado
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8084/csvPuntsWifi/api/ws/puntwifi/".$lin);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $puntwifi = json_decode($output, true);
    $codi_CAPA = $puntwifi['codi_CAPA'];
    $capa_GENERICA = $puntwifi['capa_GENERICA'];
    $nom_CAPA = $puntwifi['nom_CAPA'];
    $ed50_COORD_X = $puntwifi['ed50_COORD_X'];
    $ed50_COORD_Y = $puntwifi['ed50_COORD_Y'];
    $etrs89_COORD_X = $puntwifi['etrs89_COORD_X'];
    $etrs89_COORD_Y = $puntwifi['etrs89_COORD_Y'];
    $longitud = $puntwifi['longitud'];
    $latitud = $puntwifi['latitud'];
    $equipament = $puntwifi['equipament'];
    $districte = $puntwifi['districte'];
    $barri = $puntwifi['barri'];
    $nom_DISTRICTE = $puntwifi['nom_DISTRICTE'];
    $nom_BARRI = $puntwifi['nom_BARRI'];
    $adreca = $puntwifi['adreca'];
    $telefon = $puntwifi['telefon'];
    if ($acc == 'M') {
      $titulo = 'Editar Punto WIFI';
      $estilo = '';
    }
    else {
      $titulo = 'Eliminar Punto WIFI';
      $estilo = '';
    }
  }
 ?>
  <h1 style="text-align: center"><?php echo $titulo; ?></h1>
  <form class="form-horizontal" role="form" id="frmPuntWifi" method="post" action="puntwifi.php">
  <input type="hidden" name="hdacc" value="<?php echo $acc; ?>">
  <input type="hidden" name="hdlin" value="<?php echo $lin; ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtcodicapa">Codigo CAPA:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtcodicapa" placeholder="Código Capa" value="<?php echo $codi_CAPA; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtcapagenerica">Capa Genérica:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtcapagenerica" placeholder="Capa Generica"  value="<?php echo $capa_GENERICA; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtnomcapa">Nombre Capa:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtnomcapa" placeholder="Nombre Capa"  value="<?php echo $nom_CAPA; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txted50coordx">ED50 Coordenada X:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txted50coordx" placeholder="ED50 Coordenada X" value="<?php echo $ed50_COORD_X; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txted50coordy">ED50 Coordenada Y:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txted50coordy" placeholder="ED50 Coordenada Y" value="<?php echo $ed50_COORD_Y; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtetrs89coordx">ETRS89 Coordenada X:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtetrs89coordx" placeholder="ETRS89 Coordenada X" value="<?php echo $etrs89_COORD_X; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtetrs89coordy">ETRS89 Coordenada Y:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtetrs89coordy" placeholder="ETRS89 Coordenada Y" value="<?php echo $etrs89_COORD_Y; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtlongitud">Longitud:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtlongitud" placeholder="Longitud" value="<?php echo $longitud; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtlatitud">Latitud:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtlatitud" placeholder="Latitud" value="<?php echo $latitud; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtequipament">Equipament:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtequipament" placeholder="Equipament" value="<?php echo $equipament; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtdistricte">Districte:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtdistricte" placeholder="Districte" value="<?php echo $districte; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtbarri">Barri:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtbarri" placeholder="Barri" value="<?php echo $barri; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtnomdistricte">Nombre distrito:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtnomdistricte" placeholder="Nombre distrito" value="<?php echo $nom_DISTRICTE; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtnombarri">Nombre barrio:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtnombarri" placeholder="Nombre barrio" value="<?php echo $nom_BARRI; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtadreca">Dirección:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtadreca" placeholder="Dirección" value="<?php echo $adreca; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txttelefon">Teléfono:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txttelefon" placeholder="Teléfono" value="<?php echo $telefon; ?>">
    </div>
  </div>
  <div class="container">
  <button type="submit" name="btnAceptar" class="btn btn-primary">Aceptar</button>
  <button type="submit" name="btnCancelar" class="btn btn-primary">Cancelar</button>
  </div>
  </form>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
