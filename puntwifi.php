<?php
 class puntwifi {

   var $Linea;
   var $CodiCapa;
   var $CapaGenerica;
   var $NomCapa;
   var $ED50CoordX;
   var $ED50CoordY;
   var $ETRS89CoordX;
   var $ETRS89CoordY;
   var $Longitud;
   var $Latitud;
   var $Equipament;
   var $Districte;
   var $Barri;
   var $NomDistricte;
   var $NomBarri;
   var $Adreca;
   var $Telefon;


   function puntwifi($Linea, $CodiCapa, $CapaGenerica, $NomCapa, $ED50CoordX, $ED50CoordY, $ETRS89CoordX, $ETRS89CoordY,
   $Longitud, $Latitud, $Equipament, $Districte, $Barri, $NomDistricte, $NomBarri, $Adreca, $Telefon) {
     $this->Linea = $Linea;
     $this->CodiCapa = $CodiCapa;
     $this->CapaGenerica = $CapaGenerica;
     $this->NomCapa = $NomCapa;
     $this->ED50CoordX = $ED50CoordX;
     $this->ED50CoordY = $ED50CoordY;
     $this->ETRS89CoordX = $ETRS89CoordX;
     $this->ETRS89CoordY = $ETRS89CoordY;
     $this->Longitud = $Longitud;
     $this->Latitud = $Latitud;
     $this->Equipament = $Equipament;
     $this->Districte = $Districte;
     $this->Barri = $Barri;
     $this->NomDistricte = $NomDistricte;
     $this->NomBarri = $NomBarri;
     $this->Adreca = $Adreca;
     $this->Telefon = $Telefon;
   }

 }

  if($_POST) {
    if(isset($_POST['btnAceptar'])) {
      $acc = $_POST['hdacc'];
      $lin = $_POST['hdlin'];
      $output = true;
      $message = "";
      if ($acc == 'N') {
        $CodiCapa = $_POST['txtcodicapa'];
        $CapaGenerica = $_POST['txtcapagenerica'];
        $NomCapa = $_POST['txtnomcapa'];
        $ED50CoordX = (float) $_POST['txted50coordx'];
        $ED50CoordY = (float) $_POST['txted50coordy'];
        $ETRS89CoordX = (float) $_POST['txtetrs89coordx'];
        $ETRS89CoordY = (float) $_POST['txtetrs89coordy'];
        $Longitud = (float) $_POST['txtlongitud'];
        $Latitud = (float) $_POST['txtlatitud'];
        $Equipament = $_POST['txtequipament'];
        $Districte = (int) $_POST['txtdistricte'];
        $Barri = (int) $_POST['txtbarri'];
        $NomDistricte = $_POST['txtnomdistricte'];
        $NomBarri = $_POST['txtnombarri'];
        $Adreca = $_POST['txtadreca'];
        $Telefon = $_POST['txttelefon'];
        $vPuntWifi = new puntwifi($lin, $CodiCapa, $CapaGenerica, $NomCapa, $ED50CoordX, $ED50CoordY, $ETRS89CoordX, $ETRS89CoordY,
        $Longitud, $Latitud, $Equipament, $Districte, $Barri, $NomDistricte, $NomBarri, $Adreca, $Telefon);
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
          $CodiCapa = $_POST['txtcodicapa'];
          $CapaGenerica = $_POST['txtcapagenerica'];
          $NomCapa = $_POST['txtnomcapa'];
          $ED50CoordX = (float) $_POST['txted50coordx'];
          $ED50CoordY = (float) $_POST['txted50coordy'];
          $ETRS89CoordX = (float) $_POST['txtetrs89coordx'];
          $ETRS89CoordY = (float) $_POST['txtetrs89coordy'];
          $Longitud = (float) $_POST['txtlongitud'];
          $Latitud = (float) $_POST['txtlatitud'];
          $Equipament = $_POST['txtequipament'];
          $Districte = (int) $_POST['txtdistricte'];
          $Barri = (int) $_POST['txtbarri'];
          $NomDistricte = $_POST['txtnomdistricte'];
          $NomBarri = $_POST['txtnombarri'];
          $Adreca = $_POST['txtadreca'];
          $Telefon = $_POST['txttelefon'];
          $vPuntWifi = new puntwifi($lin, $CodiCapa, $CapaGenerica, $NomCapa, $ED50CoordX, $ED50CoordY, $ETRS89CoordX, $ETRS89CoordY,
          $Longitud, $Latitud, $Equipament, $Districte, $Barri, $NomDistricte, $NomBarri, $Adreca, $Telefon);
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
    $Linea = 0;
    $CodiCapa = '';
    $CapaGenerica = '';
    $NomCapa = '';
    $ED50CoordX = '';
    $ED50CoordY = '';
    $ETRS89CoordX = '';
    $ETRS89CoordY = '';
    $Longitud = '';
    $Latitud = '';
    $Equipament = '';
    $Districte = '';
    $Barri = '';
    $NomDistricte = '';
    $NomBarri = '';
    $Adreca = '';
    $Telefon = '';
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
    $CodiCapa = $puntwifi['CodiCapa'];
    $CapaGenerica = $puntwifi['CapaGenerica'];
    $NomCapa = $puntwifi['NomCapa'];
    $ED50CoordX = $puntwifi['ED50CoordX'];
    $ED50CoordY = $puntwifi['ED50CoordY'];
    $ETRS89CoordX = $puntwifi['ETRS89CoordX'];
    $ETRS89CoordY = $puntwifi['ETRS89CoordY'];
    $Longitud = $puntwifi['Longitud'];
    $Latitud = $puntwifi['Latitud'];
    $Equipament = $puntwifi['Equipament'];
    $Districte = $puntwifi['Districte'];
    $Barri = $puntwifi['Barri'];
    $NomDistricte = $puntwifi['NomDistricte'];
    $NomBarri = $puntwifi['NomBarri'];
    $Adreca = $puntwifi['Adreca'];
    $Telefon = $puntwifi['Telefon'];
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
      <input type="text" class="form-control" name="txtcodicapa" placeholder="Código Capa" value="<?php echo $CodiCapa; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtcapagenerica">Capa Genérica:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtcapagenerica" placeholder="Capa Generica"  value="<?php echo $CapaGenerica; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtnomcapa">Nombre Capa:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtnomcapa" placeholder="Nombre Capa"  value="<?php echo $NomCapa; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txted50coordx">ED50 Coordenada X:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txted50coordx" placeholder="ED50 Coordenada X" value="<?php echo $ED50CoordX; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txted50coordy">ED50 Coordenada Y:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txted50coordy" placeholder="ED50 Coordenada Y" value="<?php echo $ED50CoordY; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtetrs89coordx">ETRS89 Coordenada X:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtetrs89coordx" placeholder="ETRS89 Coordenada X" value="<?php echo $ETRS89CoordX; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtetrs89coordy">ETRS89 Coordenada Y:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtetrs89coordy" placeholder="ETRS89 Coordenada Y" value="<?php echo $ETRS89CoordY; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtlongitud">Longitud:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtlongitud" placeholder="Longitud" value="<?php echo $Longitud; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtlatitud">Latitud:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtlatitud" placeholder="Latitud" value="<?php echo $Latitud; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtequipament">Equipament:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtequipament" placeholder="Equipament" value="<?php echo $Equipament; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtdistricte">Districte:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtdistricte" placeholder="Districte" value="<?php echo $Districte; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtbarri">Barri:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtbarri" placeholder="Barri" value="<?php echo $Barri; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtnomdistricte">Nombre distrito:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtnomdistricte" placeholder="Nombre distrito" value="<?php echo $NomDistricte; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtnombarri">Nombre barrio:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtnombarri" placeholder="Nombre barrio" value="<?php echo $NomBarri; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txtadreca">Dirección:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txtadreca" placeholder="Dirección" value="<?php echo $Adreca; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="txttelefon">Teléfono:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="txttelefon" placeholder="Teléfono" value="<?php echo $Telefon; ?>">
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
